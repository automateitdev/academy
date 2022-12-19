<div id="notice">
    <div class="container">
        <div class="divtitle">
            <h2 style="text-align: left; color:#19686d;"> <i class="fa-solid fa-thumbtack"></i> Notice Board</h2>
            <p class="borde"></p>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="recent">
                    <h4>Recent Notice</h4>
                    <div class="content">
                        <ul class="px-4 list-group">
                            @foreach($notices as $key=>$notice)
                            @php
                            $orgDate = $notice->date;
                            $newDate = date("d-M", strtotime($orgDate));
                            $noticeDate = explode('-',$newDate);
                            if($key==5){
                            break;
                            }
                            @endphp
                            <li class="d-flex align-items-start list-group-item p-0" style="background-color:#fff">
                                <div class="px-3 py-1 m-2 text-center" style="border-radius:5px; background-color: #f2f9fb">
                                    <p class="m-0 mb-1" style="color:#19686d; font-weight:bold; border-bottom:1px solid #ddd">{{$noticeDate[1]}}</p>
                                    <p class="m-0 mb-1" style="color:darkmagenta; font-weight:bold;">{{$noticeDate[0]}}</p>
                                </div>
                                <div class="px-2 py-1"><p><a href="{{route('web.notice.view', $notice->id)}}" class="text-oblique">{{$notice->name}}</a></p></div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="shgTr">
                        <a href="#">
                            <button class="btn">See All
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rightBox">
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                    <img src="{{asset('images/apa.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <div class="content">
                                        <h4>বার্ষিক কর্মসম্পাদন চুক্তি</h4>
                                        <ul>
                                            <li><a title="নোটিশ--অফিস-আদেশ" href="http://dshe.gov.bd/site/page/2b49f7f0-b527-4f55-b100-45e8eb59ebb6/%E0%A6%A8%E0%A7%8B%E0%A6%9F%E0%A6%BF%E0%A6%B6--%E0%A6%85%E0%A6%AB%E0%A6%BF%E0%A6%B8-%E0%A6%86%E0%A6%A6%E0%A7%87%E0%A6%B6/" target="_blank" rel="noopener noreferrer"><span>নোটিশ/অফিস আদেশ</span></a></li>
                                            <li><a title="প্রজ্ঞাপন/নীতিমালা/পরিপত্র/কাঠামো" href="http://dshe.gov.bd/site/page/043d81a3-a9d9-4a72-97d2-e3af5ff14c48/%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%9C%E0%A7%8D%E0%A6%9E%E0%A6%BE%E0%A6%AA%E0%A6%A8--%E0%A6%A8%E0%A7%80%E0%A6%A4%E0%A6%BF%E0%A6%AE%E0%A6%BE%E0%A6%B2%E0%A6%BE--%E0%A6%AA%E0%A6%B0%E0%A6%BF%E0%A6%AA%E0%A6%A4%E0%A7%8D%E0%A6%B0--%E0%A6%95%E0%A6%BE%E0%A6%A0%E0%A6%BE%E0%A6%AE%E0%A7%8B/" target="_blank" rel="noopener noreferrer"><span>প্রজ্ঞাপন/নীতিমালা/পরিপত্র/কাঠামো</span></a></li>
                                            <li><a title="অধিদপ্তরের চুক্তিসমূহ/ অগ্রগতি" href="#" target="_blank" rel="noopener noreferrer">School/College APA 2020-2021</a></li>
                                            <li><a title="অধিদপ্তরের চুক্তিসমূহ/ অগ্রগতি" href="#" target="_blank" rel="noopener noreferrer">School/College APA 2021-2022</a><span></span></li>
                                            <li><a title="আঞ্চলিক কার্যালয়ের চুক্তিসমূহ" href="https://dshe.portal.gov.bd/site/page/cd86a230-8dea-472f-998b-6e5109b1c9c8/" target="_blank" rel="noopener noreferrer"><span>আঞ্চলিক কার্যালয়ের চুক্তিসমূহ</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rightBox">
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                    <img src="{{asset('images/citizen_charter.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <div class="content">
                                        <h4>তথ্য অধিকার ও সিটিজেন চার্টার</h4>
                                        <ul>
                                            <li><a title="View Employees’ Information" href="https://shed.portal.gov.bd/site/page/9c2a5d54-929a-48b5-8a23-c5958742235d" target="_blank" rel="noopener noreferrer"><span>সিটিজেন চার্টার (শিক্ষা মন্ত্রণালয়)</span></a></li>
                                            <li><a title="View Vacant and Filled-up Post" href="http://dshe.portal.gov.bd/sites/default/files/files/dshe.portal.gov.bd/office_citizen_charter/8a976a41_3872_4744_b1f4_76a0de93458b/Citizen-charter-DSHE-2019.pdf" target="_blank" rel="noopener noreferrer"><span>সিটিজেন চার্টার (মাউশি)</span></a></li>
                                            <li><a title="View Vacant and Filled-up Post" href="http://dshe.portal.gov.bd/site/page/b68fc292-322f-4e81-aee0-f8ff77a30666" target="_blank" rel="noopener noreferrer"><span>আবেদন<span>&nbsp;</span></span></a><a title="View Vacant and Filled-up Post" href="http://dshe.portal.gov.bd/site/page/b68fc292-322f-4e81-aee0-f8ff77a30666" target="_blank" rel="noopener noreferrer">ও আপিল ফরম (মাউশি)</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rightBox finalBox">
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                    <img src="{{asset('images/nis.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <div class="content">
                                        <h4>জাতীয় শুদ্ধাচার কৌশল</h4>
                                        <ul>
                                            <li><a title="শুদ্ধাচার কৌশল কর্ম পরিকল্পনা / আদেশ / বিজ্ঞপ্তি " href="http://dshe.gov.bd/site/page/%E0%A6%B6%E0%A7%81%E0%A6%A6%E0%A7%8D%E0%A6%A7%E0%A6%BE%E0%A6%9A%E0%A6%BE%E0%A6%B0-%E0%A6%95%E0%A7%8C%E0%A6%B6%E0%A6%B2-%E0%A6%95%E0%A6%B0%E0%A7%8D%E0%A6%AE-%E0%A6%AA%E0%A6%B0%E0%A6%BF%E0%A6%95%E0%A6%B2%E0%A7%8D%E0%A6%AA%E0%A6%A8%E0%A6%BE--%E0%A6%86%E0%A6%A6%E0%A7%87%E0%A6%B6---%E0%A6%AC%E0%A6%BF%E0%A6%9C%E0%A7%8D%E0%A6%9E%E0%A6%AA%E0%A7%8D%E0%A6%A4%E0%A6%BF" target="_blank" rel="noopener noreferrer"><span>শুদ্ধাচার কৌশল কর্ম পরিকল্পনা / আদেশ / বিজ্ঞপ্তি</span></a></li>
                                            <li><a title="শুদ্ধাচার কৌশল কর্ম পরিকল্পনার প্রতিবেদন" href="https://dhakacollege.edu.bd/wp-content/uploads/2021/09/NIS-DC-2021-22-doc.pdf" target="_blank" rel="noopener noreferrer">শুদ্ধাচার কৌশল কর্ম পরিকল্পনার প্রতিবেদন( NIS DC 2021-22)</a></li>
                                            <li><a href="https://dhakacollege.edu.bd/wp-content/uploads/2021/10/NIS-DC-2021-22-1st-quarterly-report.pdf" target="_blank" rel="noopener noreferrer">NIS DC 2021-22 1st quarterly report</a></li>
                                            <li><a title="শুদ্ধাচার পুরস্কার ২০১৯-২০২০" href="http://dshe.gov.bd/site/notices/27b6a8aa-8449-4775-99c5-8d761e0523c9/%E0%A6%B6%E0%A7%81%E0%A6%A6%E0%A7%8D%E0%A6%A7%E0%A6%BE%E0%A6%9A%E0%A6%BE%E0%A6%B0-%E0%A6%AA%E0%A7%81%E0%A6%B0%E0%A6%B8%E0%A7%8D%E0%A6%95%E0%A6%BE%E0%A6%B0-%E0%A7%A8%E0%A7%A6%E0%A7%A7%E0%A7%AF-%E0%A7%A8%E0%A7%A6" target="_blank" rel="noopener noreferrer"><span>শুদ্ধাচার পুরস্কার ২০১৯-২০২০</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>