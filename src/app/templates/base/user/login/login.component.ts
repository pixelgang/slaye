/*
 * Page : Login
 * Use: This page only used for admin user login functionality
 * Functionality :
 *  >> Create the login form
 *  >> Form email or username & password input field validation
 *  >> After successful form submission redirect to dashboard page
 *  >> Encrypt the user name & password for remember me concept
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA, MatSnackBar } from '@angular/material';
import { constant } from '../../../../../data/constant';
import { ApiService } from '../../../../services/api/api.service';
import { UserService } from '../../../../services/sync/user.service';
import * as crypto from 'crypto-js';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { AuthService } from '../../../../services/auth/auth.service';
import { BaseComponent } from '../../../base/base.component';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent implements OnInit {
  header: any;
  payload: any;
  rForm: FormGroup; // Declare the form object for login form
  post: any;
  result: any;
  errormessage: string;
  remberme: number;
  check_rm_me:boolean = false;
  ck_key: any;
  encrypted_text: any;
  // Variable declaration for success & error message motificcation - start
  errorMsg = '';
  errorMsgArr: any;
  ismessage = false;
  isbuttondisable = false;
  isloader= false;
  // Variable declaration for success & error message motificcation - end
  keySize:number = 256;
  ivSize:number = 128;
  iterations:number = 100;
  logo_url:any;
  constructor(
    private fb: FormBuilder,
    private route: ActivatedRoute,
    private apiService: ApiService,
    private usersService: UserService,
    @Inject(DOCUMENT) private document: HTMLDocument,
    private router: Router,
    public auth: AuthService,
    private snackBar: MatSnackBar,
    private app: BaseComponent,
    private titleService: Title
    ) {
    // Check if the user is logged or not, if logged means redirect to admin dashboard page
    if (this.auth.isAdmin) {
      this.router.navigate(['admin/dashboard']);
    }

    this.ck_key = crypto.enc.Hex.parse("KeyHexHere"); // Define the encryption key for login functionality using crypto concept
    // Declare the login form and field validation
    this.rForm = fb.group({
      'email' : [null, Validators.compose([Validators.required])],
      'password' : [null, Validators.compose([Validators.required, Validators.maxLength(25)])]
    });
  }

  ngOnInit() {
    // Here check the admin user remember me option
    var rm_me = localStorage.getItem('instasocial_rember_me');
    var rm_username = localStorage.getItem('instasocial_user_name');
    var rm_pwd = localStorage.getItem('instasocial_pwd');
    // Check the remember me values assign to local storage and user email & password prepopulated to the form fields
    if (rm_me != '' && typeof rm_me != 'undefined' && rm_me=='1') {
      var decrypted = this.decryptrm(rm_pwd, 'b9zZJSWHM7MYWYgb'); // encerypted password value decrypty in this place
      this.remberme = 1;
      this.check_rm_me = true;
      this.rForm.patchValue({
        'email' : rm_username,
        'password' : decrypted.toString(crypto.enc.Utf8)
      });
    }
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Login' );
    }
    if (this.app.site_logo != '' && typeof this.app.site_logo != 'undefined') {
      this.logo_url = this.app.site_logo;
    }
  }
  /** This function is used for remember me check box select option */
  rememberme(event) {
    if (event.checked) {
      this.remberme = 1;
    } else {
      this.remberme = 0;
    }
  }
  /** This is function is used for password input field change to text or password field */
  changetype() {
    if (this.document.getElementById('login_password').getAttribute('type') === 'password') {
      this.document.getElementById('login_password').setAttribute('type', 'text');
    } else {
      this.document.getElementById('login_password').setAttribute('type', 'password');
    }
  }
  /** This function is used for login form submission, form validation & success - error message notification display */
  loginSubmit(post) {
    this.errorMsg = '';
    this.errorMsgArr = [];
    if (this.rForm.valid) {
      // If remember me check means assign the username & password value to the localstorage
      if (this.remberme == 1) {
        var encrypted = this.encryptrm(post.password, 'b9zZJSWHM7MYWYgb');
        localStorage.setItem('instasocial_rember_me', '1');
        localStorage.setItem('instasocial_user_name', post.email);
        localStorage.setItem('instasocial_pwd', encrypted);
      } else {
        localStorage.removeItem('instasocial_rember_me');
        localStorage.removeItem('instasocial_user_name');
        localStorage.removeItem('instasocial_pwd');
      }
      this.loginAPI(constant.apiurl + constant.login, {username: post.email, password: post.password});
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
      return this.rForm.controls[field].hasError('required') ? 'Field is required' : '';
    } else if (field === 'password' ) {
      return this.rForm.controls[field].hasError('required')
      || this.rForm.controls[field].hasError('minlength')
      || this.rForm.controls[field].hasError('maxlength') ? 'Please enter valid password' : '';
    }
  }
  /** This function used for form data send to the API and successful submission redirect to the dashboard page */
  loginAPI(url, params: any) {
    this.isloader = true;
    this.isbuttondisable = true;
    this.apiService.postRequest(url, params).subscribe(
      data => {
        this.result = data;
        if (this.result.status == true) {
          if (this.result.details.role == 1) {
            this.saveUser(this.result.details);
            this.snackBar.open('Login Successful', '', {
              duration: 2000,
              verticalPosition: 'top'
            });
            this.router.navigateByUrl('/admin/dashboard');
          } else {
            this.snackBar.open('Username not recognized as admin user', '', {
              duration: 2000,
              verticalPosition: 'top'
            });
            this.isbuttondisable = false;
          }
        } else {
          this.errormessage = this.result.status_message;
          this.ismessage = true;
          this.isbuttondisable = true;
          setTimeout(() => {
            this.ismessage = false;
            this.isbuttondisable = false;
          }, 2000);
        }
      });
  }
  /** In this function we changed the user data's to the encryption format using JWT */
  saveUser(userDetails: any) {
    const header = {
      'typ': 'JWT',
      'alg': 'HS256',
    };
    const stringifiedHeader = crypto.enc.Utf8.parse(JSON.stringify(header));
    const encodedHeader = this.base64url(stringifiedHeader);
    const data = {
      'exp': Math.floor(Date.now() / 1000) + (60 * 60),
      'userid': userDetails.id,
      'username': userDetails.username,
      'first_name': userDetails.first_name,
      'last_name': userDetails.last_name,
      'email': userDetails.email,
      'access_token': userDetails.access_token,
      'role': userDetails.role
    };
    const stringifiedData = crypto.enc.Utf8.parse(JSON.stringify(data));
    const encodedData     = this.base64url(stringifiedData);
    const token           = encodedHeader + '.' + encodedData;
    const secret          = 'instasocial-By-Bsetec-2018';
    const signature       = crypto.HmacSHA256(token, secret);
    const signedToken     = token + '.' + signature;
    localStorage.setItem('instasocial_admin_name', userDetails.first_name+' '+userDetails.last_name);
    localStorage.setItem('instasocial_admin_pic', userDetails.profile_pic);
    localStorage.setItem('instasocial_token', signedToken);
  }

  base64url(source) {
    let encodedSource = crypto.enc.Base64.stringify(source);
    encodedSource = encodedSource.replace(/=+$/, '');
    encodedSource = encodedSource.replace(/\+/g, '-');
    encodedSource = encodedSource.replace(/\//g, '_');
    return encodedSource;
  }

  encryptrm (msg, pass) {
    var salt = crypto.lib.WordArray.random(128/8);
    
    var key = crypto.PBKDF2(pass, salt, {
      keySize: this.keySize/32,
      iterations: this.iterations
    });

    var iv = crypto.lib.WordArray.random(128/8);
    
    var encrypted = crypto.AES.encrypt(msg, key, { 
      iv: iv, 
      padding: crypto.pad.Pkcs7,
      mode: crypto.mode.CBC
      
    });
    
    // salt, iv will be hex 32 in length
    // append them to the ciphertext for use  in decryption
    var transitmessage = salt.toString()+ iv.toString() + encrypted.toString();
    return transitmessage;
  }

  decryptrm (transitmessage, pass) {
    var salt = crypto.enc.Hex.parse(transitmessage.substr(0, 32));
    var iv = crypto.enc.Hex.parse(transitmessage.substr(32, 32))
    var encrypted = transitmessage.substring(64);
    
    var key = crypto.PBKDF2(pass, salt, {
      keySize: this.keySize/32,
      iterations: this.iterations
    });

    var decrypted = crypto.AES.decrypt(encrypted, key, {
      iv: iv,
      padding: crypto.pad.Pkcs7,
      mode: crypto.mode.CBC
    })
    return decrypted;
  }

}
