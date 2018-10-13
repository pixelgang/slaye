/**
 * Page : Mail Setting
 * Use : Admin can possible to update mail configuration setting from back-end
 * Page Functionality :
 * >>> create mail configuration setting form
 * >>> form validation & success and error message notification
 * >>> After successful submission, display the success page
 * Created Date : 04/08/2018
 * Modified Date : 17/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { MatSnackBar } from '@angular/material';
import { FormBuilder, FormGroup , Validators } from '@angular/forms';
import { DomSanitizer } from '@angular/platform-browser';

import { FileUploader } from 'ng2-file-upload';
import { ApiService } from '../../../services/api/api.service';
import { constant } from '../../../../data/constant';
import { AdminComponent } from '../../../admin/admin.component';

@Component({
  selector: 'app-mailsetting',
  templateUrl: './mailsetting.component.html',
  styleUrls: ['./mailsetting.component.css']
})

export class MailsettingComponent implements OnInit {
  resGetSiteDetails: any;
  app_name = '';
  email = '';
  generalForm: FormGroup; // Create the form object

  // Declare the error message variable
  ismessage = false;
  is_success = false;
  isbuttondisable = false;
  errormessage: string;

  constructor(
    formbuilder: FormBuilder,
    public apiservice: ApiService,
    private snackBar: MatSnackBar,
    public sanitizer: DomSanitizer,
    private app: AdminComponent,
    private titleService: Title,
    @Inject(DOCUMENT) private document: HTMLDocument,
  ) {
    // To create the mail setting form fields and add the validation
    this.generalForm = formbuilder.group({
      'smtp_host' : [null, Validators.compose([Validators.required])],
      'smtp_port' : [null, Validators.compose([Validators.required])],
      'smtp_secure' : [null, Validators.compose([Validators.required])],
      'smtp_username' : [null, Validators.compose([Validators.required])],
      'smtp_password' : [null, Validators.compose([Validators.required])]
    });
  }

  ngOnInit() {
    // To prepopuldate the mail setting form input fields
    this.getGeneralData();
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Mail Settings' );
    }
  }
  /** This function is used for prepopulated the mail setting form field value */
  getGeneralData() {
    const getSiteDetailsUrl = constant.apiurl + constant.getmailsetdata;
    this.apiservice.getRequest(getSiteDetailsUrl).subscribe(
      data => {
        this.resGetSiteDetails = data;
        if (this.resGetSiteDetails) {
          this.generalForm.controls['smtp_host'].setValue(this.resGetSiteDetails.body.smtp_host);
          this.generalForm.controls['smtp_port'].setValue(this.resGetSiteDetails.body.smtp_port);
          this.generalForm.controls['smtp_secure'].setValue(this.resGetSiteDetails.body.smtp_secure);
          this.generalForm.controls['smtp_username'].setValue(this.resGetSiteDetails.body.smtp_username);
          this.generalForm.controls['smtp_password'].setValue(this.resGetSiteDetails.body.smtp_password);
        }
      }, err => {
        this.snackBar.open('Something went wrong, Please try again later.', '', {
          duration: 2000
        });
      });
  }
  /** This function is used for form submission, data send to the API and sussess message display */
  generalFormSubmit(formData) {
    if (this.generalForm.valid) {
        const href = constant.apiurl + constant.settingmailupdate;
        var params = {
                    user_id: this.apiservice.decodejwts().userid,
                    access_token: this.apiservice.decodejwts().access_token,
                    smtp_host: formData.smtp_host,
                    smtp_port: formData.smtp_port,
                    smtp_secure: formData.smtp_secure,
                    smtp_username: formData.smtp_username,
                    smtp_password: formData.smtp_password
                    };
        this.apiservice.postRequest(href, params).subscribe(
            data => {
                this.showSuccess();
        });
    } else {
      this.getFormMessage();
      this.showError();
    }
  }
  /** This code for success message show/hide function */
  showSuccess() {
    this.getGeneralData();
    this.is_success = true;
    setTimeout(() => {
        this.is_success = false;
      }, 2000);
  }
  /** This code for error message show/hide function */
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
    if (this.generalForm.controls['smtp_host'].hasError('required')
    || this.generalForm.controls['smtp_port'].hasError('required')
    || this.generalForm.controls['smtp_secure'].hasError('required')
    || this.generalForm.controls['smtp_username'].hasError('required')
    || this.generalForm.controls['smtp_password'].hasError('required')
  ) {
       this.errormessage =  'Fields are required';
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

}
