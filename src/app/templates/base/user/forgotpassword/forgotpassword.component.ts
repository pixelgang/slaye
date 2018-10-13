/*
 * Page : Forgot Password
 * Use: This page only used for forgot password mail send option
 * Functionality :
 *  >> Create the forgot password form
 *  >> Form input field email validation
 *  >> After successful form submission redirect to login page
 * Created Date : 03/08/2018
 * Updated Date : 18/08/2018
 * Copyright : bsetec
 */
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ApiService } from '../../../../services/api/api.service';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA, MatSnackBar } from '@angular/material';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { BaseComponent } from '../../../base/base.component';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { constant } from '../../../../../data/constant';
@Component({
  selector: 'app-forgotpassword',
  templateUrl: './forgotpassword.component.html',
  styleUrls: ['./forgotpassword.component.css']
})

export class ForgotpasswordComponent implements OnInit {
  isbuttondisable = false; // This varaible used for form submit button disable option
  forgotForm: FormGroup; // Declare the form object for forgot password form
  forgotRes: any; // This variable used for forgot password api response get option
  // Variable declaration for success & error message motificcation - start
  ismessage = false;
  errorMsg = '';
  errorMsgArr: any;
  // Variable declaration for success & error message motificcation - end
  logo_url: any;
  constructor(
    private fb: FormBuilder,
    private apiService: ApiService,
    private snackBar: MatSnackBar,
    private router: Router,
    private app: BaseComponent,
    private titleService: Title
  ) {
    // Declare the forgot password form and field validation
    this.forgotForm = fb.group({
      'email' : [null, Validators.compose([Validators.required, Validators.email])],
    });
  }

  ngOnInit() {
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Forget Password' );
    }
    if (this.app.site_logo != '' && typeof this.app.site_logo != 'undefined') {
      this.logo_url = this.app.site_logo;
    }
  }
  /** This function is used for forgot password form submission, form validation & success - error message notification display */
  forgotSubmit(formData) {
    this.errorMsg = '';
    this.errorMsgArr = [];
    if (this.forgotForm.valid) {
    // Send submitted forgotpasword form data to the api & get response
    this.apiService.postRequest(constant.apiurl + constant.forgot, { 'email' : formData.email }).subscribe(
      data => {
        this.forgotRes = data;
        if (this.forgotRes.status === true) {
          this.router.navigateByUrl('/admin/dashboard'); // This line code is redirect to the login page
          this.snackBar.open('Password sent to your mail, please check mail & login', '', {
            duration: 2000,
            verticalPosition: 'top'
          });
        } else {
          this.snackBar.open(this.forgotRes.status_message, '', {
            duration: 2000,
            verticalPosition: 'top'
          });
        }
      }, err => {
        this.snackBar.open('Something went wrong, Please try again later.', '', {
          duration: 2000
        });
      });
    } else {
      // In this part of code show/hide the error message and disable/enable the form submit button
      this.errorMsg = 'error';
      this.isbuttondisable = true;
      setTimeout(() => {
        this.isbuttondisable = false;
      }, 2000);
    }
  }

  geterrorMsg(field) {
    // In this part of code using for form validation notification
    if (field === 'email' ) {
      return this.forgotForm.controls[field].hasError('required') ? 'Field is required' : this.forgotForm.controls[field].hasError('email') ? 'please enter vaild email' : '';
    }
  }

}
