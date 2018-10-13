/*
 * Page :  Dashboard
 * Use:
 *  >> Recent Registered User list display ( recent five user )
 *  >> Display the Today Activity details count ( Users, Posts, Comments, & Likes )
 *  >> Display the total count ( video, photo, users, post, iPhone users & Andriod users list )
 *  >> Display the chart graph for user & post  activity details and filter option based graph change dynamically.
 *  >> filter options ( today, yesterday, last 7 days, last 30 days, this month, and last month & custom range )
 * Created Date : 01/08/2018
 * Updated Date : 16/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, ViewChild } from '@angular/core';
import { HttpHeaders, HttpResponse, HttpXsrfTokenExtractor, HttpClient } from '@angular/common/http';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA, MatPaginator, MatTableDataSource, MatSnackBar } from '@angular/material';
import { constant } from '../../../data/constant';
import { ApiService } from '../../services/api/api.service';
import { AdminComponent } from '../../admin/admin.component';
import { country } from '../../../data/country';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  logged_image: string;
  userID = this.apiservice.decodejwts().userid;
  apiUrl = constant.apiurl;
  userListUrl = this.apiUrl + constant.admindashboard;
  getpostuserUrl = this.apiUrl + constant.getpostuser;
  resUserData: any = [];
  // Declare the variable for user today activity and total count
  totalUserCount = 0;
  totalVideoCount = 0;
  totalPhotoCount = 0;
  totaliPhoneCount = 0;
  totalAndriodCount = 0;
  todayUser = 0;
  todayPost = 0;
  todayCmt = 0;
  todayLike = 0;
  totalPostCount = 0;
  recentuserData: any = [];
  imageUrl = constant.userimgurl;
  norecordfound = false;
  user_listing_loader:boolean = true;
  // Define the angular material table column value
  displayedColumns: string[] = ['user_id', 'username', 'email', 'created_at', 'country'];
  dataSource = new MatTableDataSource(this.recentuserData);
  countries: any = country.list; // coutry list

  /* Decalre the chart variable for user activity chart graph display - start */
  chartOptions = {
    responsive: true
  };
  chartData: any = [
    { data: [], label: '' },
    { data: [], label: '' }
  ];
  chartLabels: any = [];
  resPostUser: any;
  /* Decalre the chart variable for user activity chart graph display - end */
  // Define the filter type value for chart filter option
  types: any = [
    {value: 'today', viewValue: 'Today'},
    {value: 'yesterday', viewValue: 'Yesterday'},
    {value: 'lastweek', viewValue: 'Last 7 Days'},
    {value: 'last30day', viewValue: 'Last 30 Days'},
    {value: 'thismonth', viewValue: 'This Month'},
    {value: 'lastmonth', viewValue: 'Last Month'},
    {value: 'range', viewValue: 'Custom Range'}
  ];
  defaultSelectedType = 'thismonth';

  displayRange = false;
  // We describe the date format for filter type functionality
  public options: any = {
    locale: { format: 'YYYY-MM-DD' },
    alwaysShowCalendars: false
  };
  public daterange: any = {};

  constructor(
    private http: HttpClient,
    public apiservice: ApiService,
    private snackBar: MatSnackBar,
    public dialog: MatDialog,
    private app: AdminComponent,
    private titleService: Title
  ) {
  }

  ngOnInit() {
    var date = new Date();
    this.getDaysInMonth(date.getMonth() + 1, date.getFullYear());
    this.logged_image = constant.userimgurl + this.userID;
    // Get the details for user list API
    const getUserListUrl = this.userListUrl + '?user_id=' + this.userID + '&access_token=' + this.apiservice.decodejwts().access_token + '&order=&keyword=&sort=&page_no=1';
    this.apiservice.getRequest(getUserListUrl).subscribe(
      data => {
      this.resUserData = data;
      this.user_listing_loader = false;
      if (this.resUserData !== [] && this.resUserData.status === 200 && this.resUserData.body.status === true) {
         this.recentuserData = this.resUserData.body.result;
         this.dataSource = new MatTableDataSource(this.recentuserData);
          // To prepouldated the todat activity and total count display in dashboard 'Today acitivity' layout
         this.totalUserCount = this.resUserData.body.total;
         this.totalPostCount = this.resUserData.body.total_post;
         this.totaliPhoneCount = this.resUserData.body.total_iphone;
         this.totalAndriodCount = this.resUserData.body.total_android;
         this.totalVideoCount = this.resUserData.body.total_video;
         this.totalPhotoCount = this.resUserData.body.total_photo;
         this.todayUser = this.resUserData.body.today_user_count;
         this.todayPost = this.resUserData.body.today_post_count;
         this.todayCmt = this.resUserData.body.total_cmt_count;
         this.todayLike = this.resUserData.body.today_like_count;
      } else {
        if ( this.resUserData !== [] && this.resUserData.status === 200 && this.resUserData.body.status === false) {
          // After successful form submission display the alert notification.
          this.snackBar.open(this.resUserData.body.status_message, '', {
            duration: 2000
          });
        }
      }
    }, err => {
      // To show the error alert message for unwanted error's
      this.snackBar.open('Something went wrong, Please try again later.', '', {
        duration: 2000
      });
    });
    this.getPostUserDetails('thismonth'); // display the default graph "this month" type filter option
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Dashboard' );
    }
  }
  /** This function is used for date format change */
  formatDate(date , addDate = 0) {
    var dd = date.getDate();
    var mm = date.getMonth() + addDate;
    var yyyy = date.getFullYear();
    if (dd < 10) {dd = '0' + dd}
    if (mm < 10) {mm = '0' + mm}
    date = mm + '/' + dd + '/' + yyyy;
    return date;
  }
  /** This function is used for custom calender date selection event */
  public selectedDate(value: any, datepicker?: any) {
    // Any object can be passed to the selected event and it will be passed back here
    datepicker.start = value.start;
    datepicker.end = value.end;

    // or manupulat your own internal property
    this.daterange.start = value.start;
    this.daterange.end = value.end;
    this.daterange.label = value.label;
    var date1 = new Date(value.start);
    var date2 = new Date(value.end);
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    this.chartLabels = [];
    if (diffDays === 1) {
      this.twofourhours();
    } else {
      this.dayLabels(diffDays - 1, date2);
    }
    this.getPostUserDetails('range', this.daterange.start.format('YYYY-MM-DD HH:mm:ss'), this.daterange.end.format('YYYY-MM-DD HH:mm:ss'));
  }
  /** This function is belong to type filter dropdown menu selection based graph display option */
  onChangeType(objType) {
    this.displayRange = false;
    this.chartLabels = [];
    var date = new Date();
    if (objType === 'yesterday') {
      this.twofourhours();
    } else if (objType === 'lastweek') {
        this.dayLabels(7);
    } else if (objType === 'last30day') {
        this.dayLabels(30);
    } else if (objType === 'thismonth') {
      this.getDaysInMonth(date.getMonth() + 1, date.getFullYear());
    }  else if (objType === 'lastmonth') {
      this.getDaysInMonth(date.getMonth(), date.getFullYear());
    } else if (objType === 'today') {
      this.twofourhours();
    } else if (objType === 'range') {
      this.displayRange = true;
      return false;
    }
    this.getPostUserDetails(objType);
  }
  /** This function is used for 24 hours graph label display */
  addZero(value) {
    var pad = '00';
    return pad.substring(0, pad.length - value.toString().length) + value;
  }
  twofourhours() {
    this.chartLabels = [];
    for (var i = 1; i < 25; i++) {
      let am = 'AM';
      let pm = 'PM';
      let ampm = '';
      let timeUnit; let timeValue; let timeStamp;
      timeUnit = i > 12 ? i - 12 : i;
      timeValue = this.addZero(timeUnit);
      ampm = i < 12 || i > 23 ? am : pm;
      timeStamp = timeValue + ' ' + ampm;
      this.chartLabels.push(timeStamp);
    }
  }
  /**  This function is used for day graph label display */
  dayLabels(dayCount, date = null) {
    var result = [];
    for (var i = 0; i < dayCount; i++) {
      if (date != null) {
        var d = new Date(date);
        d.setDate(d.getDate() - i);
        result.push( this.formatDate(d, 1) );
      } else {
        var d = new Date();
        d.setDate(d.getDate() - i);
        result.push( this.formatDate(d, 1) );
      }
    }
    this.chartLabels = result.reverse();
  }
  /** This function is used for this month date label display */
  getDaysInMonth(month, year) {
    // Since no month has fewer than 28 days
    var date = new Date(year, month, 1);
    var days = [];
    while (date.getMonth() === month) {
      days.push(this.formatDate(new Date(date)));
      date.setDate(date.getDate() + 1);
    }
    this.chartLabels = days;
  }
  /** This function used for chart graph data get from API and display to the graph layout */
  getPostUserDetails(typeVal, start = '', end = '') {
    this.norecordfound = false;
    const getUserListUrl = this.getpostuserUrl + '?user_id=' + this.userID + '&access_token=' + this.apiservice.decodejwts().access_token + '&type=' + typeVal +'&start=' + start + '&end=' + end;
    this.apiservice.getRequest(getUserListUrl).subscribe(
      data => {
        this.resPostUser = data;
        if (this.resPostUser !== [] && this.resPostUser.status === 200 && this.resPostUser.body.status === true) {
          var checkPostEmpty = this.resPostUser.body.postdata.filter(Number);
          var checkUserEmpty = this.resPostUser.body.userdata.filter(Number);
          // Here we check the type count is empty or not
          if ( checkPostEmpty.length === 0 && checkUserEmpty.length === 0  ) {
            this.norecordfound = true;
          } else {
            this.chartData = [
              { data: this.resPostUser.body.postdata, label: 'Posts' },
              { data: this.resPostUser.body.userdata, label: 'Users' },
            ];
          }
        } else {
          this.snackBar.open(this.resPostUser.body.status_message, '', {
            duration: 2000
          });
        }
      }, err => {
        this.snackBar.open('Something went wrong, Please try again later.', '', {
          duration: 2000
        });
      });
  }

  /** chart function */
  onChartClick(gettype) {
  }

}
