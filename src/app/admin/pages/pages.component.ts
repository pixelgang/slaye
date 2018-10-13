/*
 * Page : Page List
 * Use: This page only used for list the cms page
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
import { environment } from './../../../environments/environment';
import { DeletionComponent } from '../dialogs/deletion/deletion.component';
import { AdminComponent } from '../../admin/admin.component';
@Component({
	selector: 'app-pages',
	templateUrl: './pages.component.html',
	styleUrls: ['./pages.component.css']
})

export class PagesComponent implements OnInit {
	// This (displayedColumns) variable used to declare the martial table column values
	displayedColumns = ['index', 'title', 'alias', 'status', 'action'];
	JobsDatabase: PagesHttpDao | null;
	data: PageslistData[] = [];
	dataSource = new MatTableDataSource<PageslistData>();
	customFilter:string;
	resultsLength:number;
	isLoadingResults = true;
	isRateLimitReached = false;
	pageEvent: PageEvent;
	perpage = constant.itemsPerPage;
	id: number;
	pages_listing_loader:boolean = true;
	@ViewChild(MatPaginator) paginator: MatPaginator;
	@ViewChild(MatSort) sort: MatSort;
	@ViewChild('filter') filter: ElementRef;

	constructor(private http: HttpClient,  public dialog: MatDialog, public snackBar: MatSnackBar, public apiservice: ApiService, private titleService: Title, private app: AdminComponent) {
	}

	ngOnInit() {
		this.JobsDatabase = new PagesHttpDao(this.http, this.apiservice);
		this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
		this.actionbk(); // This function call for initial table value display option
	}

	ngAfterViewChecked(){
		if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
			this.titleService.setTitle( this.app.page_app_name+' | Pages' );
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
					return this.JobsDatabase!.getLumenapi(
						this.sort.active, this.sort.direction, this.paginator.pageIndex, search);
				}),
				map(data => {
					this.pages_listing_loader = false;
					this.isLoadingResults = false;
					this.isRateLimitReached = false;
					this.resultsLength = data['total'];
					this.dataSource.data = data['results'];
					if (data['results'].length == 0) {
						if (this.paginator.hasPreviousPage()) {
							this.paginator.previousPage();
						}
						return data['results'];
					} else {
						return data['results'];
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
					return this.JobsDatabase!.getLumenapi(
						this.sort.active, this.sort.direction, this.paginator.pageIndex, this.dataSource.filter);
				}),
				map(data => {
					this.pages_listing_loader = false;
					this.isLoadingResults = false;
					this.isRateLimitReached = false;
					this.resultsLength = data['total'];

					return data['results'];
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

	deletebyid(id:number)  {
		this.id = id;
		const dialogRef = this.dialog.open(DeletionComponent, {
			data: {id: id,from:'page'}
		});

		dialogRef.afterClosed().subscribe(result => {
			if (result === 1) {
				this.actionbk(this.dataSource.filter);
				this.snackBar.open('Record deleted successfully.');
				setTimeout(() => {
					this.snackBar.dismiss();
				}, 1500);
			}
		});
	}
}

export interface CmsApi {
	results: PageslistData[];
	count: number;
}
/**  Assign the API response data to the 'Pageslistdata' array value */
export interface PageslistData {
	id: any;
	alias: string;
	title: string;
	status: string;
}


export class PagesHttpDao {
	constructor(private http: HttpClient, public apiservice: ApiService ) {}
	/**  This functioan is used get the cms page data's from APIs */
	getLumenapi(sort: string, order: string, page: number, filter: string=''): Observable<CmsApi> {
		const href = constant.apiurl + constant.admincmslist;
		
		const requestUrl =
		`${href}?user_id=${this.apiservice.decodejwts().userid}&access_token=${this.apiservice.decodejwts().access_token}&filter=${filter}&page=${page + 1}`;
		return this.http.get<CmsApi>(requestUrl);
	}
}