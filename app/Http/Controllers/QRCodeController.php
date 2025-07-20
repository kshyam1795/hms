<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QRCodeModel;
use App\Models\QRScan;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\Label\LabelAlignment;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    // List all codes + scan counts
    public function index()
    {
        $qrcodes = QRCodeModel::withCount('scans')->get();
        $scans   = QRScan::with('qrCode')->latest()->get();
        return view('dashboards.superadmin-partials.qrcodes.index', compact('qrcodes','scans'));
    }

    // Generate new QR + logo + label
    public function generate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        $title    = $request->title;
        $url      = $request->url;
        $unique   = uniqid('qr_');
        $diskPath = "qrcodes/{$unique}.png";
        $logoPath = public_path('assets/images/logo.png');

        // Build the QR code with logo + label in one shot:
        $result = Builder::create()
            ->writer(new PngWriter())                              // PNG output
            ->writerOptions([])                                     // default options
            ->data($url)                                            // the URL to encode
            ->encoding(new Encoding('UTF-8'))                       // character set
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)      // high ECC for logo overlay :contentReference[oaicite:0]{index=0}
            ->size(600)                                             // QR size
            ->margin(30)                                            // quiet zone
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)       // block rounding
            ->logoPath($logoPath)                                   // path to your logo
            ->logoResizeToWidth(120)                                 // resize logo to 20% of QR
            ->logoPunchoutBackground(true)                          // white bg behind logo
            ->labelText($title)                                     // add your title below
            ->labelFont(new OpenSans(20))                           // set font & size :contentReference[oaicite:1]{index=1}
            ->labelAlignment(LabelAlignment::Center)                // center the label
            ->build();

        // Save the PNG to storage
        Storage::disk('public')->put($diskPath, $result->getString());

        // Persist in DB
        $qr = QRCodeModel::create([
            'title'        => $title,
            'code'         => $unique,
            'url'          => $url,
            'qr_code_path' => $diskPath,
        ]);

        return response()->json([
            'message'      => 'QR Code Generated!',
            'qr_code'      => asset("storage/{$diskPath}"),
            'download_link'=> route('qrcodes.download', $qr->id),
        ]);
    }


    // When someone visits /qr/{code}, log and redirect
    public function track($code)
    {
        $qr = QRCodeModel::where('code',$code)->firstOrFail();

        $agent = new Agent();
        $scanData = [
            'qr_code_id' => $qr->id,
            'device'     => $agent->device(),
            'browser'    => $agent->browser(),
            'os'         => $agent->platform(),
            'ip_address' => request()->ip(),
            // you can integrate a geo-IP lookup here for latitude/longitude
        ];
        QRScan::create($scanData);

        return redirect()->away($qr->url);
    }

    // Delete QR
    public function destroy($id)
    {
        $qr = QRCodeModel::findOrFail($id);
        Storage::disk('public')->delete($qr->qr_code_path);
        $qr->delete();
        return response()->json(['message'=>'Deleted.']);
    }

    // Download raw file
    public function download($id)
    {
        $qr = QRCodeModel::findOrFail($id);
        return response()->download(storage_path("app/public/{$qr->qr_code_path}"));
    }
}