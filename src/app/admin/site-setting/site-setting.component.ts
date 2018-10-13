/**
 * Page : Site Setting
 * Page Use : Admin can possible to update the favi-icon & logo, App name & App mail address
 * Page Functionality :
 * >>> create site setting form
 * >>> form validation & success and error message notification
 * >>> After successful submission, display the success page
 * Created Date : 03/08/2018
 * Modified Date : 16/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { MatSnackBar } from '@angular/material';
import { FormBuilder, FormGroup , Validators } from '@angular/forms';
import { DomSanitizer } from '@angular/platform-browser';

import { FileUploader } from 'ng2-file-upload';
import { ApiService } from '../../services/api/api.service';
import { constant } from '../../../data/constant';
import { Setting } from '../../../model/setting';
import { AdminComponent } from '../../admin/admin.component';

@Component({
  selector: 'app-site-setting',
  templateUrl: './site-setting.component.html',
  styleUrls: ['./site-setting.component.css']
})

export class SiteSettingComponent implements OnInit {
  resGetSiteDetails: any;
  app_name = '';
  email = '';
  logo_url = '';
  favi_url = '';
  fav_icon_url = '';
  updated_logo_url = '';
  updated_favi_url = '';
  use_logo_url = '';
  use_favi_url = '';
  // To create the form object variable
  generalForm: FormGroup;

  // error & success message variable are created here
  ismessage = false;
  is_success = false;
  isbuttondisable = false;
  errormessage: string;
  // This uploader function using for site logo file upload
  public uploader: FileUploader = new FileUploader({
    url: constant.apiurl + constant.adminfileupload,
    additionalParameter: {
      type: 'site_logo'
    }
  });
  // This faviuploader function using for favi-icon file upload
  public faviuploader: FileUploader = new FileUploader({
    url: constant.apiurl + constant.adminfileupload,
    additionalParameter: {
      type: 'fav_icon'
    }
  });
  constructor(
    formbuilder: FormBuilder,
    public apiservice: ApiService,
    private snackBar: MatSnackBar,
    public sanitizer: DomSanitizer,
    private titleService: Title,
    private app: AdminComponent,
    @Inject(DOCUMENT) private document: HTMLDocument,
    ) {
    this.generalForm = formbuilder.group({
      'app_name' : [null, Validators.compose([Validators.required])],
      'email' : [null, Validators.compose([Validators.required, Validators.email])],
      'notification_flush' : [null, Validators.compose([Validators.required])],
      'onesignal_appid' : [null, Validators.compose([Validators.required])],
      'onesignal_appkey' : [null, Validators.compose([Validators.required])]
    });
  }

  ngOnInit() {
    this.getGeneralData();
    this.uploader.onAfterAddingFile = (fileItem) => {
      let url = (window.URL) ? window.URL.createObjectURL(fileItem._file) : (window as any).webkitURL.createObjectURL(fileItem._file);
      this.logo_url = url;
      fileItem.withCredentials = false;
      fileItem.upload();
    };

    this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
      var responsePath = JSON.parse(response);
      if (responsePath.status == 'false' && responsePath.errors == 'image type not supported') {
        this.errormessage = 'Image type not supported';
        this.showError();
      } else {
        this.updated_logo_url = responsePath.fileurl;
      }
    };
    this.faviuploader.onAfterAddingFile = (fileItem) => {
      let url = (window.URL) ? window.URL.createObjectURL(fileItem._file) : (window as any).webkitURL.createObjectURL(fileItem._file);
      this.favi_url = url;
      fileItem.withCredentials = false;
      fileItem.upload();
    };

    this.faviuploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
      var responsePath = JSON.parse(response);
      if (responsePath.status == 'false' && responsePath.errors == 'image type not supported') {
        this.errormessage = 'Image type not supported';
        this.showError();
      } else if (responsePath.status == 'false') {
        this.errormessage = '';
        responsePath.errors.forEach(item => {
          if (item['0'] != '' && typeof item['0'] != 'undefined') {
            this.errormessage += item['0']+'<br/>';
          }
        });
        this.favi_url = this.fav_icon_url;
        this.showError();
      } else {
        this.updated_favi_url = responsePath.fileurl;
      }
    };
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Site Settings' );
    }
  }
  /**  To prepopuldate the site setting form input fields */
  getGeneralData() {
    const getSiteDetailsUrl = constant.apiurl + constant.getgeneraldata;
    this.apiservice.getRequest(getSiteDetailsUrl).subscribe(
      data => {
        this.resGetSiteDetails = data;
        if (this.resGetSiteDetails) {
          this.app_name = this.resGetSiteDetails.body.app_name;
          this.email = this.resGetSiteDetails.body.email;
          this.generalForm.controls['app_name'].setValue(this.app_name);
          this.generalForm.controls['email'].setValue(this.email);
          this.generalForm.controls['notification_flush'].setValue(this.resGetSiteDetails.body.notification_flush);
          this.generalForm.controls['onesignal_appid'].setValue(this.resGetSiteDetails.body.onesignal_appid);
          this.generalForm.controls['onesignal_appkey'].setValue(this.resGetSiteDetails.body.onesignal_appkey);
          this.logo_url = constant.favilogoimage + this.resGetSiteDetails.body.logo_url;
          this.favi_url = constant.favilogoimage + this.resGetSiteDetails.body.favi_url;
          this.fav_icon_url = this.favi_url = constant.favilogoimage + this.resGetSiteDetails.body.favi_url;
          this.use_logo_url = this.resGetSiteDetails.body.logo_url;
          this.use_favi_url = this.resGetSiteDetails.body.favi_url;
          this.document.getElementById('app_name').innerHTML = this.app_name;
          this.document.getElementById('app_footer').innerHTML = this.app_name;
          this.document.getElementById('appFavicon').setAttribute('href', constant.favilogoimage + this.resGetSiteDetails.body.favi_url);
        }
      }, err => {
        // To show the error alert message for unwanted error's
        this.snackBar.open('Something went wrong, Please try again later.', '', {
          duration: 2000
        });
      });
  }
  /**  This function is used for form submission, data send to the API and sussess message display */
  generalFormSubmit(formData) {
    if (this.generalForm.valid) {
      // Logo & Favi image are required field, here we validate and display the notification
      if (this.logo_url === '' || this.favi_url === '') {
        this.getFormMessage();
        this.showError();
      } else {
        this.updated_logo_url = this.updated_logo_url == '' ? this.use_logo_url : this.updated_logo_url;
        this.updated_favi_url = this.updated_favi_url == '' ? this.use_favi_url : this.updated_favi_url;
        const href = constant.apiurl + constant.settingupdate;
        var params = {
          user_id: this.apiservice.decodejwts().userid,
          access_token: this.apiservice.decodejwts().access_token,
          app_name: formData.app_name,
          email: formData.email,
          front_logo: this.updated_logo_url,
          fav_icon: this.updated_favi_url,
          notification_flush: formData.notification_flush,
          onesignal_appid: formData.onesignal_appid,
          onesignal_appkey: formData.onesignal_appkey
        };
        this.apiservice.postRequest(href, params).subscribe(
          data => {
            this.showSuccess();
                // singleton update
                this.apiservice.init(constant.apiurl + constant.getgeneraldata, 'callapi').subscribe(row => {
                  this.document.getElementById('app_name').innerHTML = row.app_name;
                  this.document.getElementById('appFavicon').setAttribute('href', constant.favilogoimage + row.favi_url);
                });
              });
      }
    } else {
      this.getFormMessage();
      this.showError();
    }
  }
  /* show&hide the success message notification in form submission */
  showSuccess() {
    this.getGeneralData();
    this.is_success = true;
    setTimeout(() => {
      this.is_success = false;
    }, 2000);
  }
  /* show&hide the error message notification in form submission */
  showError() {
    this.isbuttondisable = true;
    this.ismessage = true;
    setTimeout(() => {
      this.ismessage = false;
      this.isbuttondisable = false;
    }, 2000);
  }
  /** To create the form required validation message */
  getFormMessage () {
    if (this.generalForm.controls['app_name'].hasError('required') || this.generalForm.controls['email'].hasError('required')
        || this.generalForm.controls['notification_flush'].hasError('required')
        || this.generalForm.controls['onesignal_appid'].hasError('required')
        || this.generalForm.controls['onesignal_appkey'].hasError('required')
      ) {
        this.errormessage =  'Fields are required';
    }  else if (this.generalForm.controls['email'].hasError('email')) {
      this.errormessage = 'Invalid email';
    } else if (this.logo_url === '' || this.favi_url === '') {
      this.errormessage = 'Application logo is required';
      if (this.favi_url === '') {
        this.errormessage = 'Application favi icon is required';
      }
    }
  }
  /** numberOnly function using for input field only can enter number character functionality */
  numberOnly(event): boolean {
    const charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }

  fileSelected(e) {
  }

}
