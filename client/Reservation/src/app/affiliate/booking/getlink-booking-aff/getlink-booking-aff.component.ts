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
      "id": 1,
      "tour": "TC-01 : Doi Suthep Temple & Hmong Hill Tribe Village",
      "link": "http://tour-in-chiangmai.com/doi-suthep-temple-&-hmong-hill-tribe-village.php"
    },
    {
      "id": 2,
      "tour": "TC-02 : City Temple & Museum",
      "link": "http://tour-in-chiangmai.com/city-temple-&-museum.php"
    },
    {
      "id": 3,
      "tour": "TC-03 : Elephant at Work & Riding @ Mae Sa Elephant Camp",
      "link": "http://tour-in-chiangmai.com/elephant-at-work.php"
    },
    {
      "id": 4,
      "tour": "TC-04 : Handicraft Village",
      "link": "http://tour-in-chiangmai.com/handicraft-village.php"
    },
    {
      "id": 5,
      "tour": "TC-05A : Chiang Mai Night Safari (Afternoon Trip; Day Safari)",
      "link": "http://tour-in-chiangmai.com/chiang-mai-night-safari-(afternoon).php"
    },
    {
      "id": 6,
      "tour": "TC-05E : Chiang Mai Night Safari (Evening Trip)",
      "link": "http://tour-in-chiangmai.com/chiang-mai-night-safari.php"
    },
    {
      "id": 7,
      "tour": "TC-06 : Khan Toke Dinner with Cultural Performances",
      "link": "http://tour-in-chiangmai.com/khan-toke-dinner-with-cultural-performances.php"
    },
    {
      "id": 8,
      "tour": "TC-07 : Elephant Safari @ Mae Taman Elephant Camp",
      "link": "http://tour-in-chiangmai.com/elephant-safari.php"
    },
    {
      "id": 9,
      "tour": "TC-08 : Chiang Rai Day Trip",
      "link": "http://tour-in-chiangmai.com/chiang-rai-one-day-trip.php"
    },
    {
      "id": 10,
      "tour": "TC-09 : Inthanon National Park",
      "link": "http://tour-in-chiangmai.com/inthanon-national-park.php"
    },
    {
      "id": 11,
      "tour": "TC-10 : Elephant Trek to Long Neck and Tiger Kingdom",
      "link": "http://tour-in-chiangmai.com/elephant-trek-to-long-neck-and-tiger-kingdom.php"
    },
    {
      "id": 12,
      "tour": "TC-11 : Elephant Conservation Center @ Lampang",
      "link": "http://tour-in-chiangmai.com/elephant-conservation-center-lampang.php"
    },
    {
      "id": 13,
      "tour": "TC-12 : Trekking Doi Suthep Area",
      "link": "http://tour-in-chiangmai.com/trekking-doi-suthep-area.php"
    },
    {
      "id": 14,
      "tour": "TC-S01 : Kew Mae Pan Natural Trail",
      "link": "http://tour-in-chiangmai.com/kiew-mae-pan-natural-trail.php"
    },
    {
      "id": 15,
      "tour": "TC-S02M : Breath of Nature (Morning)",
      "link": "http://tour-in-chiangmai.com/breath-of-nature-(morning).php"
    },
    {
      "id": 16,
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
    this.linkAllTour = website+'?user='+this.token;
    // console.log(this.linkAllTour);
  }

  // 5. set link tour program (by tour)
  setLinkTourProgramByTour(){
    let website = this.linkByTour;
    let length = this.tourLink.length;
    let tourId = <any>"";

    if(this.linkByTour.link==""){
      this.linkTour = "";
    }else{
      for(let i=0; i<length; i++){
        if(this.tourLink[i].link==website){
          tourId = this.tourLink[i].id * 23 + 1327;
        }
      }
      this.linkTour = website+'?user='+this.token+'&tour='+tourId;
    }
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
