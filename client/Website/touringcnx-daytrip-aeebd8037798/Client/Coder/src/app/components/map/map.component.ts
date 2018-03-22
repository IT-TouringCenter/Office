import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {
  title: string = 'Touring Center';
  lat: number = 18.789495;
  lng: number = 98.991232;
  
  constructor() { }

  ngOnInit() {
    this.getUserLocation();
  }

  private getUserLocation() {
    if (navigator.geolocation) {
      console.log('location');
      
      navigator.geolocation.getCurrentPosition(position => {
        this.lat = this.lat; //position.coords.latitude;
        this.lng =this.lng; // position.coords.longitude;       
      });
    }
  }

}
