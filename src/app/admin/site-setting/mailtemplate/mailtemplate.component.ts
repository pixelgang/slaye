/**
 * Page : Mail Setting
 * Use : Admin can possible to update mail template from back-end
 * Page Functionality :
 * >>> create mail template setting form
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

@Component({
  selector: 'app-mailtemplate',
  templateUrl: './mailtemplate.component.html',
  styleUrls: ['./mailtemplate.component.css']
})

export class MailtemplateComponent implements OnInit {
  resGetSiteDetails: any;
  app_name = '';
  email = '';
  // form variables
  generalForm: FormGroup;

  // error message display
  ismessage = false;
  is_success = false;
  isbuttondisable = false;
  errormessage: string;

  constructor(
    formbuilder: FormBuilder,
    public apiservice: ApiService,
    private snackBar: MatSnackBar,
    public sanitizer: DomSanitizer,
    @Inject(DOCUMENT) private document: HTMLDocument,
  ) {
    // To create the mail template form fields and add the validation
    this.generalForm = formbuilder.group({
      'register_template' : [null, Validators.compose([Validators.required])],
      'forgot_template' : [null, Validators.compose([Validators.required])],
      'post_ready' : [null, Validators.compose([Validators.required])],
      'common_post' : [null, Validators.compose([Validators.required])],
      'report_abuse' : [null, Validators.compose([Validators.required])],
    });
  }

  ngOnInit() {
    // To prepopuldate the mail template form input fields
    this.getGeneralData();
  }

  getGeneralData() {
    const getSiteDetailsUrl = constant.apiurl + constant.getmailtemplate;
    this.apiservice.getRequest(getSiteDetailsUrl).subscribe(
      data => {
        this.resGetSiteDetails = data;
        if (this.resGetSiteDetails) {
          this.generalForm.controls['register_template'].setValue(this.resGetSiteDetails.body.register_template);
          this.generalForm.controls['forgot_template'].setValue(this.resGetSiteDetails.body.forgot_template);
          this.generalForm.controls['post_ready'].setValue(this.resGetSiteDetails.body.post_ready);
          this.generalForm.controls['common_post'].setValue(this.resGetSiteDetails.body.common_post);
          this.generalForm.controls['report_abuse'].setValue(this.resGetSiteDetails.body.report_post);
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
        const href = constant.apiurl + constant.updatemailtemplate;
        var params = {
                    user_id: this.apiservice.decodejwts().userid,
                    access_token: this.apiservice.decodejwts().access_token,
                    register_template: formData.register_template,
                    forgot_template: formData.forgot_template,
                    post_ready_template: formData.post_ready,
                    common_post_template: formData.common_post,
                    report_post: formData.report_abuse
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
    if (this.generalForm.controls['register_template'].hasError('required')
    || this.generalForm.controls['forgot_template'].hasError('required')
    || this.generalForm.controls['post_ready'].hasError('required')
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
