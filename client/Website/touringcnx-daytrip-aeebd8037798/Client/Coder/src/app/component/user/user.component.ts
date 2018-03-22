import { Component, OnInit } from '@angular/core';
import { DataService } from '../../services/data.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  name: string;
  age: number;
  email: string;
  address: Address;
  hobbies: string[];
  hello: any;
  posts: Posts[];
  isEdit: boolean = false;

  constructor(private dataService: DataService) {
    console.log('Contructor ran...');
  }

  ngOnInit() {
    console.log('ngOnInit ran...');

    this.name = 'Panawat Atjanawat';
    this.age = 32;
    this.email = 'patjanawat@gmail.com';
    this.address = {
      street: '50 Main St',
      city: 'Boston',
      state: 'MA'
    };
    this.hobbies = ['Write code', 'Watch pvoces', 'Listen to music'];
    this.hello = 'Hello';

    this.dataService.getPosts().subscribe((posts) => {
      console.log(posts);
      this.posts = posts;
    });
  }

  onClick() {
    console.log('OnClick event.');
    this.name = 'mamgmo maoplin';
    this.hobbies.push('New hobby');
  }

  addHobby(hobby) {
    console.log(hobby);
    this.hobbies.unshift(hobby);
    return false;
  }

  deleteHobby(hobby) {
    console.log(hobby);
    for(let i = 0; i < this.hobbies.length; i++) {
      if(this.hobbies[i] == hobby) {
        this.hobbies.splice(i,1);
      }
    }
  }

  toggleEdit() {
    console.log('edit toggle');
    this.isEdit = !this.isEdit;
  }
}

interface Address {
  street: string;
  city: string;
  state: string;
}

interface Posts{
  id: number;
  title: string;
  body: string;
  userId: number;
}