/*
 * Page : Post List
 * Use: This page only used for list the user posts
 * Functionality :
 *  >> Create the angular material table
 *  >> Fetch the data's from APIs
 *  >> Added the filter & pagination option
 * Created Date : 03/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, AfterViewInit, ViewChild, ChangeDetectorRef, ElementRef, Input } from '@angular/core';
import { HttpHeaders, HttpResponse, HttpXsrfTokenExtractor, HttpClient } from '@angular/common/http';
import { MatSnackBar, MatTableDataSource, MatPaginator, MatSort, MatDialog, MatDialogRef, MAT_DIALOG_DATA, MatIcon, PageEvent } from '@angular/material';
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
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})

export class PostsComponent implements OnInit {
  // This (displayedColumns) variable used to declare the martial table column values
  displayedColumns = ['index', 'user_name', 'post_text', 'post_status', 'post_like_count', 'post_comment_count', 'created_at', 'action'];
  PostsDatabase: PostsHttpDao | null;
  data: PostsData[] = [];
  dataSource = new MatTableDataSource<PostsData>();
  customFilter:string;
  resultsLength:number;
  isLoadingResults = true;
  isRateLimitReached = false;
  pageEvent: PageEvent;
  app_name:any;
  perpage = constant.itemsPerPage;
  posts_listing_loader:boolean = true;
  pg_number:number=0;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('filter') filter: ElementRef;
  @Input() aList;

  constructor(private http: HttpClient, public apiservice: ApiService, private titleService: Title, private app: AdminComponent, private activatedRoute: ActivatedRoute) {
  }

  ngOnInit() {
    this.activatedRoute.queryParams.subscribe(params => { 
      if (params.page != '' && typeof params.page != 'undefined') {
        this.paginator.pageIndex = params.page;
        this.pg_number = params.page;
      }
    });
    this.PostsDatabase = new PostsHttpDao(this.http, this.apiservice);
    this.actionbk(); // This function call for initial table value display option
    
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Post Listings' );
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
        return this.PostsDatabase!.getLumenapi(
          this.sort.active, this.sort.direction, this.paginator.pageIndex, search);
      }),
      map(data => {
        this.posts_listing_loader = false;
        this.isLoadingResults = false;
        this.isRateLimitReached = false;
        this.resultsLength = data['count'];
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
    }else{
      merge(this.sort.sortChange, this.paginator.page)
        .pipe(
          startWith({}),
          switchMap(() => {
            this.isLoadingResults = true;
            return this.PostsDatabase!.getLumenapi(
              this.sort.active, this.sort.direction, this.paginator.pageIndex, this.dataSource.filter);
          }),
          map(data => {
            this.posts_listing_loader = false;
            this.isLoadingResults = false;
            this.isRateLimitReached = false;
            this.resultsLength = data['count'];

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
  /**  This function is used for search text based user list display in material table */
  applyFilter(filterValue: string,empty:number){
    if(empty==0){
     this.customFilter = "";
     this.dataSource.filter = "";
     this.filter.nativeElement.value = "";
     this.actionbk();
    }else{
      if (filterValue != '' && typeof filterValue != 'undefined') {
        this.dataSource.filter = filterValue;
        this.paginator.pageIndex = 0;
        if(this.pageEvent){
          this.pageEvent.pageIndex = 0;  
        }
        this.actionbk(filterValue.toLowerCase());  
      }
    }
  }
}

export interface PostsApi {
  results: PostsData[];
  count: number;
}
/**  Assign the API response data to the 'PostsData' array value */
export interface PostsData {
  post_id: any;
  user_name: string;
  post_text: string;
  post_status: string;
  post_like_count: number;
  post_comment_count: number;
  created_at: number;
}


export class PostsHttpDao {

  constructor(private http: HttpClient, public apiservice: ApiService) { }
  /** This functioan is used get the cms page data's from APIs */
  getLumenapi(sort: string, order: string, page: number, filter: string=''): Observable<PostsApi> {
    const href = constant.apiurl + constant.adminposts;
    const requestUrl =
			`${href}?user_id=${this.apiservice.decodejwts().userid}&access_token=${this.apiservice.decodejwts().access_token}&keyword=${filter}&page_no=${page + 1}`;
    return this.http.get<PostsApi>(requestUrl);
  }
}
