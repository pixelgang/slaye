/*
 * Page : User Profile
 * Use: This page only used for admin user has view the register user profile details
 * Functionality :
 *  >>> Prepopulated the user details
 *  >>> Admin can possible the enable/disable the user
 *  >>> Display the post, followed and comments list.
 *  >>> Scroll based data fetch option added in this layout
 * Created Date : 03/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { MatSnackBar } from '@angular/material';

import { ApiService } from '../../../services/api/api.service';
import { constant } from '../../../../data/constant';
import { country } from '../../../../data/country';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { TruncatetextPipe } from './truncatetext.pipe';
import { AdminComponent } from '../../../admin/admin.component';
@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})

export class ProfileComponent implements OnInit {
   userId = this.apiservice.decodejwts().userid;
   access_token = this.apiservice.decodejwts().access_token;
   memberId: any;
   imageUrl = constant.userimgurl;
  // Declare the user profile details prepopulate variable
  countryLists = country.list;
  first_name: any; last_name: any; email: any; join_from: any; member_country: any; lastlogin: any;
  memberDatas: any = []; memberProfileImg: any;
  resMemberPostData: any = []; memberPostData: any = [];
  resMemberFollowerData: any = []; memberFollowerData: any = [];
  totalFollowerCount = 0; pagenofollower = 1;
  resMemberFollowingData: any = []; memberFollowingData: any = [];
  totalFollowingCount = 0; pagenofollowing = 1;
  isnodatapost = false; isnodatafollower = false; isnodatafollowing = false;
  status_checked = true;
  user_status = 'active';
  resUpdateUser: any = [];
  user_listing_loader:boolean = true;
  follower_listing_loader:boolean = true;
  following_listing_loader:boolean = true;
  // Following variable declaration using for scroll based datas fetch option - start
  throttle = 100;
  scrollDistance = 2;
  page_no = 1;
  totalPageCount = 0;
  // Following variable declaration using for scroll based datas fetch option - start
  dob: any;
  state: any;
  gender: any;
  description: any;
  username: any;
  device_type: any;
  response_msg: any;
  morelessText:string = 'More';
  textLength:number = 150;
  initialTextLength:number = 150;
  showBtn = -1;
  page_number:number;
  constructor(
    private activatedRoute: ActivatedRoute,
    public apiservice: ApiService,
    private snackBar: MatSnackBar,
    private router: Router,
    private titleService: Title,
    private app: AdminComponent
    ) {

    this.router.routeReuseStrategy.shouldReuseRoute = function(){
      return false;
    };
    this.router.events.subscribe((evt) => {
      if (evt instanceof NavigationEnd) {
        this.router.navigated = true;
        window.scrollTo(0, 0);
      }
    });
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | User Details' );
    }
  }

  ngOnInit() {
     this.activatedRoute.queryParams.subscribe(params => { 
        this.page_number = params.page; 
     });
    // Get the user id from current active url for member details prepopulate functionality
    this.activatedRoute.params.subscribe(params => {
      this.memberId = params['id'];
    });
    const memberDetailUrl = constant.apiurl + constant.memberdetails + '?userid=' + this.userId + '&access_token=' + this.access_token + '&member_id=' + this.memberId;
    this.apiservice.getRequest(memberDetailUrl).subscribe(
      data => {
        this.memberDatas = data;
        if (this.memberDatas.body.status === true) {
          this.username = this.memberDatas.body.details.username;
          this.first_name = this.memberDatas.body.details.first_name;
          this.last_name = this.memberDatas.body.details.last_name;
          this.email = this.memberDatas.body.details.email;
          this.member_country = this.memberDatas.body.details.country;
          this.join_from = this.formatDate(new Date(this.memberDatas.body.details.updated_at.date));
          this.lastlogin = this.memberDatas.body.details.modified_ago;
          if (this.memberDatas.body.details.dob != '' && typeof this.memberDatas.body.details.dob != 'undefined' && this.memberDatas.body.details.dob!='0000-00-00') {
            this.dob = this.formatDate(new Date(this.memberDatas.body.details.dob));
          }
          if (this.memberDatas.body.details.state != '' && typeof this.memberDatas.body.details.state != 'undefined') {
            this.state = this.memberDatas.body.details.state;
          }
          if (this.memberDatas.body.details.gender != '' && typeof this.memberDatas.body.details.gender != 'undefined') {
            this.gender = this.memberDatas.body.details.gender;
          }
          if (this.memberDatas.body.details.description != '' && typeof this.memberDatas.body.details.description != 'undefined') {
            this.description = this.memberDatas.body.details.description;
          }
          if (this.memberDatas.body.details.device_type != '' && typeof this.memberDatas.body.details.device_type != 'undefined') {
            this.device_type = this.memberDatas.body.details.device_type;
          }
          this.status_checked = this.memberDatas.body.details.user_status === 'active' ? true : false;
        } else {
          // If member id don't have any details page redirect to the dashboard page
          this.router.navigateByUrl('/admin/dashboard');
        }
      }, err => {
        this.snackBar.open('Something went wrong, Please try again later.', '', {
          duration: 2000
        });
      });
      // Display the five count of post, follower & following user list - start
      this.memberPostList();
      this.memberFollowerList();
      this.memberFollowingList();
      // Display the five count of post, follower & following user list - end
    }
  /** This function using for member post list API call and prepopulate */
  memberPostList() {
    const memberDetailUrl = constant.apiurl + constant.memberpostlist + '?user_id=' + this.userId + '&access_token=' + this.access_token + '&keyword=&member_id=' + this.memberId + '&page_no=' + this.page_no;
    this.apiservice.getRequest(memberDetailUrl).subscribe(
      data => {
        this.user_listing_loader = false;
        this.resMemberPostData = data;
        if (this.resMemberPostData.body.status === true) {
          this.resMemberPostData.body.result.map(item => {

            return item;
          }).forEach(item => {
            var twemoji = require('twemoji');
            item.post_text = twemoji.parse(eval('(function(){ return "'+ item.post_text +'"})()'));
            this.memberPostData.push(item);
          });
          this.totalPageCount = this.resMemberPostData.body.no_page;
        }  else {
          this.isnodatapost = true;
        }
      });
  }
  /** This function using for member follower list API call and prepopulate */
  memberFollowerList() {
    const memberDetailUrl = constant.apiurl + constant.memberfollowerlist + '?record=&username=&user_id=' + this.userId + '&access_token=' + this.access_token + '&keyword=&member_id=' + this.memberId + '&page_no=' + this.pagenofollower;
    this.apiservice.getRequest(memberDetailUrl).subscribe(
      data => {
        this.follower_listing_loader = false;
        this.resMemberFollowerData = data;
        if (this.resMemberFollowerData.body.status === true && this.resMemberFollowerData.body.total_count !== 0) {
          this.resMemberFollowerData.body.result.map(item => {
            return item;
          }).forEach(item => this.memberFollowerData.push(item));
          this.totalFollowerCount = this.resMemberFollowerData.body.no_page;
        } else {
          this.isnodatafollower = true;
        }
      });
  }
  /** This function using for member following list API call and prepopulate */
  memberFollowingList() {
    const memberDetailUrl = constant.apiurl + constant.memberfollowinglist + '?record=&username=&user_id=' + this.userId + '&access_token=' + this.access_token + '&keyword=&member_id=' + this.memberId + '&page_no=' + this.pagenofollowing;
    this.apiservice.getRequest(memberDetailUrl).subscribe(
      data => {
        this.following_listing_loader = false;
        this.resMemberFollowingData = data;
        if (this.resMemberFollowingData.body.status === true && this.resMemberFollowingData.body.total_count !== 0) {
          this.resMemberFollowingData.body.result.map(item => {
            return item;
          }).forEach(item => this.memberFollowingData.push(item));
          this.totalFollowingCount = this.resMemberFollowingData.body.no_page;
        } else {
          this.isnodatafollowing = true;
        }
      });
  }
  /** This function help for scroll based post list generate functionality */
  onScrollDown() {
    this.page_no = this.page_no + 1;
    if (this.page_no <= this.totalPageCount) {
      this.user_listing_loader = true;
      this.memberPostList();
    }
  }
  /** This function help for scroll based follower list generate functionality */
  onScrollDownFollower() {
    this.pagenofollower = this.pagenofollower + 1;
    if (this.pagenofollower <= this.totalFollowerCount) {
      this.follower_listing_loader = true;
      this.memberFollowerList();
    }
  }
  /** This function help for scroll based following list generate functionality */
  onScrollDownFollowing() {
    this.pagenofollowing = this.pagenofollowing + 1;
    if (this.pagenofollowing <= this.totalFollowingCount) {
      this.following_listing_loader = true;
      this.memberFollowingList();
    }
  }
  /** This function using for user active status update functionality */
  updateUserstatus(status) {
    if (status.checked) {
      this.user_status = 'active';
    } else {
      this.user_status = 'inactive';
    }

    var href = constant.apiurl + constant.userstatusupdate;
    var params = {
      userid: this.userId,
      access_token: this.access_token,
      member_id: this.memberId,
      status: this.user_status
    };
    this.apiservice.postRequest(href, params).subscribe(
      result => {
        this.resUpdateUser = result;
        if (this.resUpdateUser.status) {
          this.response_msg = this.resUpdateUser.message;
        } else {
          this.response_msg = this.resUpdateUser.message;
        }

        this.snackBar.open(this.response_msg, '', {
          duration: 2000,
          verticalPosition: 'top'
        });
      }, error => {
        this.snackBar.open('Something went wrong please try again later', '', {
          duration: 2000,
          verticalPosition: 'top'
        });
      });
  }
  /** This function used for change date format for DOB date value prepopulate */
  formatDate(date) {
    var dd = date.getDate();
    var mm = date.getMonth() + 1;
    var yyyy = date.getFullYear();
    if (dd < 10) {dd = '0' + dd}
      if (mm < 10) {mm = '0' + mm}
        date = mm + '/' + dd + '/' + yyyy;
      return date;
    }

    showUndoBtn(index, textMoreLess) {
      if (textMoreLess === 'less') {
        this.showBtn = index;
      } else {
        this.showBtn = -1;
      }
    }

    onMoreFun(textlength, findText) {
      if ( findText === 'More') {
        this.textLength = textlength;
        this.morelessText = 'Less';
      } else {
        this.textLength = 20;
        this.morelessText = 'More';
      }
      this.morelessText = this.morelessText;
      if ( textlength < this.initialTextLength ) {
        this.morelessText = '';
      }
    }

  }
