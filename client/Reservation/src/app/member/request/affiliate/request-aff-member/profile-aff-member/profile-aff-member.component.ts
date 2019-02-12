import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { HttpClient, HttpEventType } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profile-aff-member',
  templateUrl: './profile-aff-member.component.html',
  styleUrls: ['./profile-aff-member.component.scss']
})

export class ProfileAffMemberComponent implements OnInit {

  // variable
  public profile = {
    fullname: '',
    birth: '',
    tel: '',
    email: '',
    nationality: '',
    address: '',
    idNumber: '',
    profilePicture: '',
    copyIdCard: ''
  };

  profileUpload: File = null;
  idCardUpload: File = null;

  constructor(
    private http: Http,
    private https: HttpClient,
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(999));
    sessionStorage.setItem('sub-menu',JSON.stringify(999));
  }

  // 2. window back
  public windowBack(){
    this.router.navigate(['user/member/request/affiliate/howto']);
  }

  // 3. window next
  public windowNext(){
    let setData = this.setDataToStorage(this.profile);

    if(setData==true){
      this.router.navigate(['user/member/request/affiliate/step2']);
    }
  }

  // Logic
  // 4. get data profile (api)
  public GetAccountProfile(){
    // check storage
    let checkStorage = JSON.parse(sessionStorage.getItem('set-profile'));
    if(checkStorage){
      this.bindingData(checkStorage);
      return;
    }

    // get user
    let user = JSON.parse(localStorage.getItem('users'));
    let token = '';

    if(user){
      token = user.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    let url = 'http://localhost:9000/api/Dashboard/Member/GetAccountProfile';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/GetAccountProfile';

    let users = {
      token: token
    }

    let options = new RequestOptions();
    return this.http.post(url, users, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        sessionStorage.setItem('req-profile',JSON.stringify(data.data[0])),
                        this.bindingData(data.data[0])
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. binding data
  public bindingData(data){
    // set data to form
    this.profile.fullname = data.fullname;
    this.profile.birth = data.birth;
    this.profile.tel = data.tel;
    this.profile.email = data.email;
    this.profile.nationality = data.nationality;
    this.profile.address = data.address;
    this.profile.idNumber = data.idNumber;
    // this.profile.profilePicture = data.picture;
    // this.profile.copyIdCard = data.copyIdCard;
  }

  // 6. set profile data to storage
  public setDataToStorage(data){
    sessionStorage.setItem('set-profile',JSON.stringify(data));    
    let getData = sessionStorage.getItem('set-profile');

    if(getData){
      return true;
    }else{
      return false;
    }
  }

  // Save images to directory
  // input profile image
  // handleProfileInput(files: FileList){
  //   this.profileUpload = files.item(0);
  //   this.profile.profilePicture = this.profileUpload.name;
  //   console.log(this.profileUpload);
  // }

  // // input copy id card image
  // handleCopyIDInput(files: FileList){
  //   this.idCardUpload = files.item(0);
  //   this.profile.copyIdCard = this.idCardUpload.name;
  //   console.log(this.idCardUpload);
  // }

  // // 
  // onUploadPictureFile(fileToUpload: File){
  //   const uploadData = new FormData();
  //   uploadData.append('image', this.profileUpload, this.profileUpload.name);
  //   this.https.post('http://tour-in-chiangmai.com/images/', uploadData) 
  //                 .subscribe(
  //                   event => {
  //                     console.log(event); // handle event here
  //                   }
  //                 );
  // }

  ngOnInit() {
    this.activeMenu();
    this.GetAccountProfile();
  }

}
