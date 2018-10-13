/*
 * Page : Profile Setting
 * Use: This page only used for admin user profile details update functionality
 * Functionality :
 *  >> Create the profile form
 *  >> Form input field validation & profile image upload option
 *  >> After successful form submission show the success message
 *  >> We have change password layout and form for this page
 * Created Date : 08/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, AfterViewInit, ViewChild, ChangeDetectorRef, ElementRef, Inject } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import {constant} from '../../../../data/constant';
import {country} from '../../../../data/country';
import { FileUploader } from 'ng2-file-upload';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from './../../../../environments/environment';
import { Title, Meta, DOCUMENT }     from '@angular/platform-browser';
import { ApiService } from '../../../services/api/api.service';
import { UserService } from '../../../services/sync/user.service';
import { AdminComponent } from '../../../admin/admin.component';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css']
})

export class SettingsComponent implements OnInit {

  editForm: FormGroup; // Declare the form object for profile setting form
  // Variable declaration for success & error message motificcation - start
  ismessage:boolean = false;
  isbuttondisable:boolean = false;
  isloader:boolean= false;
  result: any;
  errormessage: string;
  issuccess:boolean= false;
  successmessage: string;
  // Variable declaration for success & error message motificcation - end
  post: any;
  countries: any = country.list; // This variable using for static country list display
  initdata: any;
  profilepic: string = '';
  profileurl: string = '';
  file_upload_loader:boolean = false;
  @ViewChild('uploadEl') uploadElRef: ElementRef;

  public allowedMimeType = ['image/png', 'image/jpeg', 'image/gif']; // Define the image mime type for file upload validation process
  // This uploader function using for update the admin user profile image
  public uploader: FileUploader = new FileUploader({
    url: constant.apiurl + constant.adminfileupload,
    allowedMimeType: this.allowedMimeType,
    additionalParameter: {
      type: 'useravatar'
    }
  });

  constructor(private route: ActivatedRoute, private fb: FormBuilder, public sanitizer:DomSanitizer, private apiService: ApiService, private usersService:UserService, private titleService: Title, 
    private metaService: Meta, @Inject(DOCUMENT) private document: HTMLDocument, private app: AdminComponent) {
    this.getInitialProfileInfo();
    // Declare the profile edit form and field validation
    this.editForm = fb.group({
      'email': [null, Validators.compose([Validators.required, Validators.email])],
      'firstname': [null, Validators.compose([Validators.required])],
      'lastname': [null, Validators.compose([Validators.required])],
      'username': [null, Validators.compose([Validators.required, Validators.minLength(2)])],
      'state': [null],
      'country': [null, Validators.compose([Validators.required])],
      'gender': ['', Validators.compose([Validators.required])],
    });
  }

  ngOnInit() {
    this.usersService.headerinfoAlerts(this.apiService.decodejwts().username);
    this.uploader.onAfterAddingFile = (fileItem) => {
      this.file_upload_loader = true;
      let url = (window.URL) ? window.URL.createObjectURL(fileItem._file) : (window as any).webkitURL.createObjectURL(fileItem._file);
      this.profilepic = url;
      fileItem.withCredentials = false;
      fileItem.upload();
    };

    this.uploader.onWhenAddingFileFailed = (fileItem) => {
      this.errormessage = 'Please upload image file only';
      this.ismessage = true;
      setTimeout(() => {
        this.ismessage = false;
        this.isbuttondisable = false;
      }, 2000);
    };

    this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
      this.file_upload_loader = false;
      var responsePath = JSON.parse(response);
      this.profileurl = responsePath.fileurl;
      this.uploadElRef.nativeElement.value = '';
    };
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Profile & Change Password Settings' );
    }
  }
  /** This function used for prepopulate the admin user data details */
  getInitialProfileInfo() {
    var url = constant.apiurl+constant.adminprofileinfo+'?userid='+this.apiService.decodejwts().userid+'&access_token='+this.apiService.decodejwts().access_token;
    this.apiService.getRequest(url).subscribe(
      row => {
        this.initdata = row;
        if (this.initdata.body.status != false) {
          var items = this.initdata.body.details;
          this.profilepic = items.profile_pic;
          this.editForm.patchValue({
            'firstname' : items.first_name,
            'lastname' : items.last_name,
            'username' : items.username,
            'email' : items.email,
            'state' : items.state,
            'country' : items.country,
            'gender' : items.gender,
            'profile_pic' : items.profile_pic
          });
        }
      });
  }
  /** This function is used to prepare the form data and header layout profile picture and admin name up */
  editprofileSubmit(post) {
    if (this.editForm.valid) {
      var profile_param;
      if (this.profileurl != '' && typeof this.profileurl != 'undefined') {
        profile_param = {
          userid:this.apiService.decodejwts().userid,
          access_token:this.apiService.decodejwts().access_token,
          first_name:post.firstname,
          last_name:post.lastname,
          state:post.state,
          country:post.country,
          username:post.username,
          gender:post.gender,
          email:post.email,
          profile_pic:this.profileurl
        };
        localStorage.setItem('instasocial_admin_name', post.firstname+' '+post.lastname);
        localStorage.setItem('instasocial_admin_pic', constant.apiurl+'uploads/images/user/'+this.profileurl);
      }else{
        profile_param = {
          userid:this.apiService.decodejwts().userid,
          access_token:this.apiService.decodejwts().access_token,
          first_name:post.firstname,
          last_name:post.lastname,
          state:post.state,
          country:post.country,
          username:post.username,
          gender:post.gender,
          email:post.email
        };
        localStorage.removeItem('instasocial_admin_name');
        localStorage.setItem('instasocial_admin_name', post.firstname+' '+post.lastname);
      }
      this.saveeditform(constant.apiurl + constant.adminsaveprofile,profile_param);
    } else {
      this.getFormMessage();
      this.showError();
    }
  }
  /** This function using for save the updated admin user details */
  saveeditform(url, params: any) {
    this.isloader = true;
    this.isbuttondisable = true;
    this.apiService.postRequest(url, params).subscribe(
      data => {
        this.isbuttondisable = false;
        this.isloader = false;
        this.result = data;
        if (this.result.status == true) {
          this.successmessage = this.result.status_message;
          this.issuccess = true;
          this.isbuttondisable = true;
          this.usersService.headerinfoAlerts(this.apiService.decodejwts().username);
          setTimeout(() => {
            this.issuccess = false;
            this.isbuttondisable = false;
          }, 2000);
        } else {
          this.errormessage = '';
          this.result.errors.forEach(item => {
            this.errormessage += item['0']+'<br/>';
          });
          this.ismessage = true;
          this.isbuttondisable = true;
          setTimeout(() => {
            this.ismessage = false;
            this.isbuttondisable = false;
          }, 2000);
        }
      });
  }
  /** This function is used for error message show & hide option after form submit */
  showError() {
    this.isbuttondisable = true;
    this.ismessage = true;
    setTimeout(() => {
      this.ismessage = false;
      this.isbuttondisable = false;
    }, 2000);
  }

  getFormMessage () {
    // In this part of code using for form validation notification
    if (this.editForm.controls['firstname'].hasError('required')
      || this.editForm.controls['lastname'].hasError('required')
      || this.editForm.controls['country'].hasError('required') || this.editForm.controls['username'].hasError('required') || this.editForm.controls['email'].hasError('required')) {
      this.errormessage =  'Fields are required';
    }else if (this.editForm.controls['email'].hasError('email')) {
      this.errormessage = 'Invalid email';
    }
  }
}
