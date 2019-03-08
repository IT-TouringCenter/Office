import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-getlink-booking-aff',
  templateUrl: './getlink-booking-aff.component.html',
  styleUrls: ['./getlink-booking-aff.component.scss']
})
export class GetlinkBookingAffComponent implements OnInit {

  // variable
  linkAllTour = <any>"";
  linkTour = <any>"";

  token = <any>"";

  linkByTour = <any>"";
  tourLink = [
    {
      "tour": "TC-01 : Doi Suthep Temple & Hmong Hill Tribe Village",
      "link": "http://tour-in-chiangmai.com/doi-suthep-temple-&-hmong-hill-tribe-village.php"
    },
    {
      "tour": "TC-02 : City Temple & Museum",
      "link": "http://tour-in-chiangmai.com/city-temple-&-museum.php"
    },
    {
      "tour": "TC-03 : Elephant at Work & Riding @ Mae Sa Elephant Camp",
      "link": "http://tour-in-chiangmai.com/elephant-at-work.php"
    },
    {
      "tour": "TC-04 : Handicraft Village",
      "link": "http://tour-in-chiangmai.com/handicraft-village.php"
    },
    {
      "tour": "TC-05A : Chiang Mai Night Safari (Afternoon Trip; Day Safari)",
      "link": "http://tour-in-chiangmai.com/chiang-mai-night-safari-(afternoon).php"
    },
    {
      "tour": "TC-05E : Chiang Mai Night Safari (Evening Trip)",
      "link": "http://tour-in-chiangmai.com/chiang-mai-night-safari.php"
    },
    {
      "tour": "TC-06 : Khan Toke Dinner with Cultural Performances",
      "link": "http://tour-in-chiangmai.com/khan-toke-dinner-with-cultural-performances.php"
    },
    {
      "tour": "TC-07 : Elephant Safari @ Mae Taman Elephant Camp",
      "link": "http://tour-in-chiangmai.com/elephant-safari.php"
    },
    {
      "tour": "TC-08 : Chiang Rai Day Trip",
      "link": "http://tour-in-chiangmai.com/chiang-rai-one-day-trip.php"
    },
    {
      "tour": "TC-09 : Inthanon National Park",
      "link": "http://tour-in-chiangmai.com/inthanon-national-park.php"
    },
    {
      "tour": "TC-10 : Elephant Trek to Long Neck and Tiger Kingdom",
      "link": "http://tour-in-chiangmai.com/elephant-trek-to-long-neck-and-tiger-kingdom.php"
    },
    {
      "tour": "TC-11 : Elephant Conservation Center @ Lampang",
      "link": "http://tour-in-chiangmai.com/elephant-conservation-center-lampang.php"
    },
    {
      "tour": "TC-12 : Trekking Doi Suthep Area",
      "link": "http://tour-in-chiangmai.com/trekking-doi-suthep-area.php"
    },
    {
      "tour": "TC-S01 : Kew Mae Pan Natural Trail",
      "link": "http://tour-in-chiangmai.com/kiew-mae-pan-natural-trail.php"
    },
    {
      "tour": "TC-S02M : Breath of Nature (Morning)",
      "link": "http://tour-in-chiangmai.com/breath-of-nature-(morning).php"
    },
    {
      "tour": "TC-S02A : Breath of Nature (Afternoon)",
      "link": "http://tour-in-chiangmai.com/breath-of-nature-(afternoon).php"
    }
  ];

  constructor() {
    
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(5));
    sessionStorage.setItem('sub-menu',JSON.stringify(501));
  }

  // 3. get token
  getToken(){
    // get storage
    let getUser = JSON.parse(localStorage.getItem('users'));
    if(getUser){
      this.token = getUser.data.token;
      this.setLinkTourProgram();
    }else{
      this.token = '';
    }
  }

  // 4. set link all tour
  setLinkTourProgram(){
    let website = "http://tour-in-chiangmai.com/tours.php";
    this.linkAllTour = website+'?aff='+this.token;
    console.log(this.linkAllTour);
  }

  // 5. set link tour program (by tour)
  setLinkTourProgramByTour(){
    let website = this.linkByTour;
    if(this.linkByTour==""){
      this.linkTour = "";
    }else{
      this.linkTour = website+'?aff='+this.token;
    }
    console.log(this.linkTour);
  }

  // 6. copy link all program
  copyLink(inputElement){
    inputElement.select();
    document.execCommand('copy');
    inputElement.setSelectionRange(0, 0);
  }

  // 7. copy link by program
  copyLinkByProgram(){

  }

  ngOnInit() {
    this.activeMenu();
    this.getToken();
  }

}
