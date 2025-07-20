@extends('welcome')
@section('web-content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    /* body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f4f4;
    } */
    .treeF {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100%;
    }
    .treeF ul {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-top: 20px;
        position: relative;
    }
    .treeF ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 2px;
        height: 20px;
        background: #000;
    }
    .treeF li {
        margin: 0 20px;
        position: relative;
        padding: 10px 0;
    }
    .treeF li::before, .treeF li::after {
        content: '';
        position: absolute;
        top: 0;
        width: 50%;
        height: 20px;
        border-top: 2px solid #000;
    }
    .treeF li::after {
        right: 0;
        border-left: 2px solid #000;
    }
    .treeF li::before {
        left: 0;
        border-right: 2px solid #000;
    }
    .treeF li:first-child::before, .treeF li:last-child::after {
        border: none;
    }
    .nodeF {
        display: inline-block;
        padding: 15px 20px;
        border-radius: 8px;
        background: #123f56;
        color: white;
        font-weight: bold;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .nodeF:hover {
        transform: scale(1.05);
        background: #036f9e;
    }
    .treeF ul ul {
        display: flex;
        justify-content: center;
        position: relative;
        padding-top: 20px;
    }
</style>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    /* body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    } */
    .tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    .tree ul {
        list-style-type: none;
        position: relative;
        padding-left: 40px;
    }
    .tree ul::before {
        content: "";
        position: absolute;
        top: 0;
        left: 20px;
        border-left: 2px solid #000;
        width: 2px;
        height: 100%;
    }
    .tree li {
        position: relative;
        margin: 20px 0;
        padding-left: 20px;
    }
    .tree li::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 20px;
        border-top: 2px solid #000;
    }
    .node {
        display: inline-block;
        padding: 12px 20px;
        border-radius: 6px;
        background: #123f56;
        color: white;
        font-weight: bold;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .node:hover {
        transform: scale(1.05);
        background: #036f9e;
    }
</style>

<div class="title-section dark-bg module">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>Our Staff</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             <li><span class="show-for-sr">Current: </span> Our Staff</li>
          </ul>
       </div>
    </div>
 </div>
 <div class="our-staff module">
    <div class="grid-container grid-x grid-padding-x">
        <div class="large-12 medium-12 small-12 cell" style="text-align: center"><h2><u>Board of Trustee</u></h2></div>
        <div class="large-4 medium-6 small-12 cell">
            <div class="staff-box hover-wrap">
               <div class="hover-img">
                  <img src="{{ asset('assets/images/mr-behl.png')}}" alt="Staff Images" />
                  <div class="staff-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="staff-text hover-bottom">
                  <h6><a href="#">Shri Sushil Behl, S/o Late Prof.(Dr.) P.N. BEHL</a></h6>
                  <p>Mananging Trustee</p>
               </div>
            </div>
         </div>
         <div class="large-8 medium-6 small-12 cell">
            <div class="staff-box hover-wrap">
               
               <div class="staff-text hover-bottom">
                  
                  <p style="font-size: 14px;line-height: 2.5;text-align: justify;padding: 2% 4%; height: 420px;">	<b>Shri Sushil Behl, S/o  Lt. Dr P.N. Behl,</b> is the Managing Trustee at Dr Behl’s Skin Hospital. He has over 25 years of experience bringing a wealth of leadership, vision, and dedication to the hospital. With his deep commitment to healthcare excellence and a passion for advancing the field of dermatology, Shri Sushil Behl has played a pivotal role in shaping the institute’s growth and success. Under his guidance, Dr Behl’s Skin Hospital has evolved into a leading centre for dermatological care, offering state-of-the-art treatments and services that address the skin health needs of a diverse patient population. Shri Sushil Behl manages the institution through the overall operations, strategic direction, finances, staff, patient care quality, compliance with regulations, and ensuring the hospital runs efficiently to achieve hospital goals, essentially acting as the primary leader in day-to-day hospital management. </p>
                </div>
            </div>
        </div>
        @php
            $staffT = [
                // ['position' => 'Managing Trustee', 'names' => ['Shri Sushil Behl, S/o Late Prof.(Dr.) P.N. Behl']],
                // ['position' => 'Trustee Members', 'names' => ['Shri Subhash Chandra Singhal', 'Dr P K Goswami', 'Dr S K Bose', 'Mrs Shashi M Kapila']],
               ];

               $staffF = [
                    ['position' => 'Chief Dermatologist', 'names' => ['Prof. (Dr.) Asok Aggarwal, MBBS, MD']],
                    ['position' => 'Senior Consultants', 'names' => [
                        'Dr. (Mrs.) Poonam Sharma - MBBS, MD',
                        'Dr. Vikas Kapoor - MBBS, MD',
                        'Dr. (Mrs) Akshi Pandita - MBBS, MD',
                        'Dr. Premanshu Bhushan - MBBS, MD'
                    ]],
                    ['position' => 'Consultants', 'names' => [
                        'Dr. Padmanabh Gupta - MBBS, MD',
                        'Dr. (Mrs) Priya Choudhary - MBBS, MD',
                        'Dr. (Mrs.) Richa Arora - MBBS, MD',
                        'Dr. (Mrs) Aishwarya Raheja - MBBS, MD, DNB'
                    ]],
                    ['position' => 'Surgeons & Senior Consultants', 'names' => [
                        'Dr. Shiv Chopra - MBBS, MS, MRCS (Glasg.)',
                        'Dr. Charanjeev Sobti - MBBS, MS, MCh Plastic Surgeon',
                        'Dr. Rohit Nayar - MD, Hair Transplant'
                    ]],
                ];


            $staff = [
                
                ['position' => 'CEO', 'names' => ['Mrs. Priya Behl']],
                ['position' => 'Director Administration', 'names' => ['Colonel B P Segan (Retd.)']],
                ['position' => 'MS/CMO', 'names' => ['Dr. Kishore Singh']],
                // ['position' => 'Registrar', 'names' => ['Mr. A.K. Chakraborty']],
                // ['position' => 'Accountant', 'names' => ['Mr. A.K. Nigam', 'Mr. H.K. JHA']],
                // ['position' => 'Human Resources', 'names' => ['Mr. Ankur Saxena']],
                // ['position' => 'EDP Incharge', 'names' => ['Mr. Upender Khushwah', 'Mr. Surjeet Kumar Sharma']],
                // ['position' => 'Pharmacist', 'names' => ['Mr. Ashok Kumar']],
                // ['position' => 'Chief Lab. Supervisor', 'names' => ['Ms. Manjit Kaur']],
                // ['position' => 'Lab. Supervisor', 'names' => ['Mrs. Shimy Reji']],
                // ['position' => 'Matron', 'names' => ['Mrs. Saramma Philip', 'Mrs. Rohini']],
                // ['position' => 'Therapist', 'names' => ['Mr. K.N. Narayanam', 'Mr. Lalit']],
                // ['position' => 'Cosmetologists', 'names' => ['Mrs Neelam Arora', 'Mrs Heera Devi', 'Mrs Jyoti Singh', 'Mrs Jagriti']],
                // ['position' => 'Store Incharge', 'names' => ['Mrs. Baljit Kaur']],
                // ['position' => 'Receptionists', 'names' => ['Mrs. Gracy', 'Miss. Aarti Kotnala', 'Mrs Gayatri', 'Mrs Neha', 'Mr Mohit', 'Mrs Nutan Kanth', 'Mrs Krishna Sharma']],
            ];
        @endphp

        <div class="treeF">
            <ul>
                @foreach($staffT as $memberT)
                    <li>
                        <div class="nodeF">{{ $memberT['position'] }}</div>
                        <ul>
                            @foreach($memberT['names'] as $name)
                                <li><div class="nodeF">{{ $name }}</div></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="large-12 medium-12 small-12 cell" style="text-align: center"><h2><u>Department</u></h2></div>
        <div class="treeF">
            <ul>
                @foreach($staff as $memberT)
                    <li>
                        <div class="nodeF">{{ $memberT['position'] }}</div>
                        <ul>
                            @foreach($memberT['names'] as $name)
                                <li><div class="nodeF">{{ $name }}</div></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        
    </div>
         
         
      <div class="large-12 medium-12 small-12 cell" style="text-align: center"><h2><u>Faculty</u></h2></div>
      <div class="tree">
        <ul>
            @foreach($staffF as $member)
                <li>
                    <div class="node">{{ $member['position'] }}</div>
                    <ul>
                        @foreach($member['names'] as $name)
                            <li><div class="node">{{ $name }}</div></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>  
      
    
</div>



<style>
.staff-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease;
    margin: 10px;
}
.staff-card:hover {
    transform: scale(1.05);
}
.card-content h3 {
    font-size: 1.5em;
    color: #333;
    margin-bottom: 10px;
}
.card-content ul {
    list-style: none;
    padding: 0;
}
.card-content ul li {
    font-size: 1.2em;
    color: #555;
}
</style>


@endsection