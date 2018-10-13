/*
 * Page : User List
 * Use: This page only used for list the registered user list
 * Functionality :
 *  >> Create the angular material table
 *  >> Fetch the data's from APIs
 *  >> Added the filter & pagination option
 * Created Date : 03/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, AfterViewInit, ViewChild, ChangeDetectorRef, ElementRef, Inject } from '@angular/core';
import { HttpHeaders, HttpResponse, HttpXsrfTokenExtractor, HttpClient } from '@angular/common/http';
import { MatSnackBar, MatTableDataSource, MatPaginator, MatSort, MatIcon, PageEvent } from '@angular/material';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';

import { constant } from '../../../data/constant';
import { ApiService } from '../../services/api/api.service';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from '.././../../environments/environment';
import { AdminComponent } from '../../admin/admin.component';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})

export class UsersComponent implements OnInit {
  // This (displayedColumns) variable used to declare the martial table column values
  displayedColumns = ['index', 'user_id' ,'first_name', 'last_name', 'username', 'email', 'post_count', 'follower_count', 'following_count', 'status', 'action'];
  usersDatabase: UsersHttpDao | null;
  data: UsersData[] = [];
  dataSource = new MatTableDataSource<UsersData>();
  customFilter:string;
  resultsLength:number;
  isLoadingResults = true;
  isRateLimitReached = false;
  pageEvent: PageEvent;
  perpage = constant.itemsPerPage;
  user_img_path:string;
  pg_number:number=0;
  user_listing_loader:boolean = true;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('filter') filter: ElementRef;

  constructor(private http: HttpClient, public apiservice: ApiService, private titleService: Title, private app: AdminComponent, private activatedRoute: ActivatedRoute) {
  }

  ngOnInit() {
    this.activatedRoute.queryParams.subscribe(params => { 
      if (params.page != '' && typeof params.page != 'undefined') {
        this.paginator.pageIndex = params.page;
        this.pg_number = params.page;
      }
    });
    this.user_img_path = constant.userimgurl;
    this.usersDatabase = new UsersHttpDao(this.http, this.apiservice);
    this.actionbk(); // This function call for initial table value display option
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | User Listings' );
    }
  }

  ConvertToInt(val){
    return parseInt(val);
  }
  /** This function is used for get data's from API and display to the material table */
  actionbk(search:string=''){
    if (search != '' && typeof search != 'undefined') {
      merge()
      .pipe(
      startWith({}),
      switchMap(() => {
        this.isLoadingResults = true; // Before data fetching display the loader image
        return this.usersDatabase!.getLumenapi(
          this.sort.active, this.sort.direction, this.paginator.pageIndex, search);
      }),
      map(data => {
        this.user_listing_loader = false;
        this.isLoadingResults = false;
        this.isRateLimitReached = false;
        this.resultsLength = data['total'];
        this.dataSource.data = data['result'];
        if (data['result'].length == 0) {
          if (this.paginator.hasPreviousPage()) {
            this.paginator.previousPage();
          }
          return data['result'];
        } else {
          return data['result'];
        }
      }),
      catchError(() => {
        this.isLoadingResults = false;
        this.isRateLimitReached = true;
        return observableOf([]);
      })
      ).subscribe(data => this.data = data);
    } else {
      merge(this.sort.sortChange, this.paginator.page)
        .pipe(
          startWith({}),
          switchMap(() => {
            this.isLoadingResults = true;
            return this.usersDatabase!.getLumenapi(
              this.sort.active, this.sort.direction, this.paginator.pageIndex, this.dataSource.filter);
          }),
          map(data => {
            this.user_listing_loader = false;
            this.isLoadingResults = false;
            this.isRateLimitReached = false;
            this.resultsLength = data['total'];

            return data['result'];
          }),
          catchError(() => {
            this.isLoadingResults = false;
            this.isRateLimitReached = true;
            return observableOf([]);
          })
        ).subscribe(data => this.data = data);
    }
  }
  /** This function is used for search text based user list display in material table */
  applyFilter(filterValue: string, empty: number) {
    if (empty == 0) {
     this.customFilter = '';
     this.dataSource.filter = '';
     this.filter.nativeElement.value = '';
     this.actionbk();
    } else {
      if (filterValue != '' && typeof filterValue != 'undefined') {
        this.dataSource.filter = filterValue;
        this.paginator.pageIndex = 0;
        if (this.pageEvent) {
          this.pageEvent.pageIndex = 0;
        }
        this.actionbk(filterValue.toLowerCase());
      }
    }
  }
}

export interface UsersApi {
  results: UsersData[];
  count: number;
}
/** Assign the API response data to the 'UserData' array value */
export interface UsersData {
  user_id: any;
  first_name: string;
  last_name: string;
  username: string;
  email: string;
  post_count: number;
  follower_count: number;
  following_count: number;
  status: number;
}

export class UsersHttpDao {

  constructor(private http: HttpClient, public apiservice: ApiService) { }
  /** This functioan is used get the API data's from lumen */
  getLumenapi(sort: string, order: string, page: number, filter: string=''): Observable<UsersApi> {
    const href = constant.apiurl + constant.adminusers;
    const requestUrl =
			`${href}?user_id=${this.apiservice.decodejwts().userid}&access_token=${this.apiservice.decodejwts().access_token}&keyword=${filter}&page_no=${page + 1}`;
    return this.http.get<UsersApi>(requestUrl);
  }

}
