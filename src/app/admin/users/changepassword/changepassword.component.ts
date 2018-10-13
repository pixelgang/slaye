/*
 * Page : Change Password
 * Use: This page only used for change the current password
 * Functionality :
 *  >> Create the change password form
 *  >> Form input field validation
 *  >> After successful form submission, show the success message notification
 * Created Date : 08/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';
import { constant } from '../../../../data/constant';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from './../../../../environments/environment';
import { Title, Meta, DOCUMENT }     from '@angular/platform-browser';
import { ApiService } from '../../../services/api/api.service';
import { UserService } from '../../../services/sync/user.service';
import { MatSnackBar,MatDialog,MatDialogRef } from '@angular/material';

@Component({
  selector: 'app-changepassword',
  templateUrl: './changepassword.component.html',
  styleUrls: ['./changepassword.component.css']
})

export class ChangepasswordComponent implements OnInit {

  changepasswordForm: FormGroup; // Declare the form object for change password form
  // Variable declaration for success & error message motificcation - start
  ismessage:boolean = false;
  isbuttondisable:boolean = false;
  isloader:boolean= false;
  result:any; 
  errormessage:string;
  issuccess:boolean= false;
  successmessage:string;
  // Variable declaration for success & error message motificcation - end
  constructor(
    private router: Router,
    public dialog: MatDialog,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private sanitizer: DomSanitizer,
    private apiService: ApiService,
    private usersService: UserService,
    private titleService: Title,
    private metaService: Meta,
    @Inject(DOCUMENT) private document: HTMLDocument
  ) {
    // Declare the change password form and field validation
    this.changepasswordForm = fb.group({
      'old_password' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
      'new_password' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
      'conf_password' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])]
    });
  }
  // This function is used to avoid the whitespace in the form input field
  public noWhitespaceValidator(control: FormControl) {
    let isWhitespace = (control.value || '').trim().length === 0;
    let isValid = !isWhitespace;
    return isValid ? null : { 'whitespace': true };
  }

  ngOnInit() {
    this.usersService.headerinfoAlerts(localStorage.getItem('username'));
  }
  /** This function is used for change password form submission, form validation & success - error message notification display */
  changepasswordSubmit(formData) {
    if (this.changepasswordForm.valid) {
      var checkPassword = 'valid';
      var old_password = formData.old_password != "" && formData.old_password != null ? formData.old_password.trim() : "";
      var new_password = formData.new_password != "" && formData.new_password != null ? formData.new_password.trim() : "";
      var conf_password = formData.conf_password != "" && formData.conf_password != null ? formData.conf_password.trim() : "";
      //Password validation
      if(old_password != "" || new_password != "" || conf_password != "") {
        if(new_password == conf_password) {
          if(new_password.length <= 4 || new_password.length >=25 ) {
            checkPassword = "length_not_valid";
          } else {
            checkPassword = "valid";
          }
        } else {
          checkPassword = "not_same";
        }
      } else {
        checkPassword = "not_valid";
      }
      // After validate for input field allow to form submission
      if(checkPassword == 'valid') {
        var href = constant.apiurl+constant.adminchangepassword;
        var params = {
                  userid : this.apiService.decodejwts().userid,
                  access_token : this.apiService.decodejwts().access_token,
                  old_password : old_password,
                  new_password : new_password,
                };
        this.apiService.postRequest(href,params).subscribe(
            data => {
              if (data['status'] == true) {
                  this.isbuttondisable = true;
                  this.successmessage = data['status_message'];
                  this.issuccess = true;
                  setTimeout(() => {
                    this.issuccess = false;
                    this.isbuttondisable = false;
                    this.logout();
                  }, 1000);
              } else {
                if (data['readyState'] == 4) {
                  this.errormessage =  "Session expired, please login again";
                } else {
                  this.errormessage =  data['status_message'];
                }
                this.showError();
              }          
            });
      } else {
          if(checkPassword == 'length_not_valid') {
            this.errormessage =  "Password must minimum 5 character and less then 25 character";
          } else if(checkPassword == 'not_same') {
            this.errormessage =  "New password & Confirm password not same, Please check";
          } else {
            this.errormessage =  "Please check the New password & Confirm password";
          }
        this.showError();
      }
    } else {
      this.getFormMessage();
      this.showError();
    }
  }

  getFormMessage () {
    // In this part of code using for form validation notification
    if(this.changepasswordForm.controls['old_password'].hasError('whitespace') == false || this.changepasswordForm.controls['old_password'].hasError('required')
    || this.changepasswordForm.controls['new_passWord'].hasError('whitespace') == false || this.changepasswordForm.controls['new_passWord'].hasError('required')
    || this.changepasswordForm.controls['conf_password'].hasError('whitespace') == false || this.changepasswordForm.controls['conf_password'].hasError('required')
    ) {
       this.errormessage =  'Fields are required';
    }
  }
  /** This function is using for show&hide error message notification after form submission */
  showError() {
    this.isbuttondisable = true;
    this.ismessage = true;
    setTimeout(() => {
      this.ismessage = false;
      this.isbuttondisable = false;
    }, 2000);
  }
  /** This function help to direct admin login, after change the password. */
  logout() {
    localStorage.removeItem('instasocial_admin_name');
    localStorage.removeItem('instasocial_admin_pic');
    localStorage.removeItem('instasocial_token');
    this.router.navigate(['/']);
   }

}
