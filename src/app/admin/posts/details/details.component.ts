/*
 * Page : Post Detail
 * Use: This page only used for admin user post details
 * Functionality :
 *  >>> Prepopulated the post details
 *  >>> Admin can possible the enable/disable the post
 *  >>> Display the post, comments and like list.
 *  >>> Comments search functionality
 *  >>> Comments enable & disable option
 * Created Date : 10/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA, MatSnackBar } from '@angular/material';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';
import { constant } from '../../../../data/constant';
import { Title, Meta, DOCUMENT, DomSanitizer } from '@angular/platform-browser';
import { environment } from '.././../../../environments/environment';
import { AdminComponent } from '../../../admin/admin.component';
@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})

export class DetailsComponent implements OnInit {
  result_to_form:any;
  created_at_ago:string;
  media_data = [];
  user_image:string;
  comment_count:number;
  like_count:number;
  first_name:string;
  last_name:string;
  user_name:string;
  post_text:string;
  post_location:string;
  cmt_results:any;
  loadMorebtn:boolean;
  cmts_default_page = 1;
  cmts_inc_page:number = 1;
  total_cmts_page:number;
  cmtsInfo = [];
  cmt_restult_status:any;
  norecords:boolean;
  user_img_path:string;
  user_id:number;
  lks_results:any;
  loadMorelkbtn:boolean;
  lks_default_page = 1;
  lks_inc_page:number = 1;
  total_lks_page:number;
  lksInfo = [];
  lksnorecords:boolean;
  cmt_listing_loader:boolean = true;
  restult_status:any;
  response_msg:any;
  post_status:string;
  status_checked:boolean;
  search_text: string = '';
  search_options = [{'type': 'ALL', 'value':'all'},{'type': 'Active', 'value':'active'},{'type': 'Inactive', 'value':'inactive'}]
  search_selected:string;
  search_value:any;
  search_type:any;
  page_number:number;
  constructor(
    private api: ApiService,
    private router:Router,
    @Inject(DOCUMENT) private document: HTMLDocument,
    private titleService: Title,
    private route:ActivatedRoute,
    private snackBar: MatSnackBar,
    private app: AdminComponent, private activatedRoute: ActivatedRoute ) {
      this.search_type = 'all';
      this.search_value = '';
  }

  ngOnInit() {
    this.activatedRoute.queryParams.subscribe(params => { 
        this.page_number = params.page; 
     });
  	this.search_selected = 'all';
    this.user_img_path = constant.userimgurl;
    /* We display the initial comment, post & like lists and details */
  	this.getDetails();
  	this.loadcmts();
  	this.loadlks();
  }

  ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | Post Detail' );
    }
  }

  getDetails(){
        const id = this.route.snapshot.paramMap.get('id');
        var href = constant.apiurl+constant.adminpostdetails+'?user_id='+this.api.decodejwts().userid+'&access_token='+this.api.decodejwts().access_token+'&post_id='+id;
        this.api.getRequest(href).subscribe(result => {
            this.result_to_form = result;
        },error => {
            this.router.navigate(['/admin/posts']);
        },() => {
            // Convert the unicode to smiley image using twemoji plug-in
            var twemoji = require('twemoji');
            var post_txt = twemoji.parse(eval('(function(){ return "' + this.result_to_form.body.result["0"].post_text + '"})()'));
            this.post_location = this.result_to_form.body.result["0"].post_locations;
            this.post_text = post_txt;
            this.user_id = this.result_to_form.body.result["0"].user_id;
            this.user_name = this.result_to_form.body.result["0"].user_name;
            this.created_at_ago = this.result_to_form.body.result["0"].created_at_ago;
            this.user_image = this.result_to_form.body.result["0"].user_image;
            this.comment_count = this.result_to_form.body.result["0"].post_comment_count;
            this.like_count = this.result_to_form.body.result["0"].post_like_count;
            this.first_name = this.result_to_form.body.result["0"].user_first_name;
            this.last_name = this.result_to_form.body.result["0"].user_last_name;
            this.status_checked = this.result_to_form.body.result["0"].post_status;
            this.media_data = this.result_to_form.body.result["1"].media;
        });
    }

    loadcmts(){
    	const id = this.route.snapshot.paramMap.get('id');
		var api_url = constant.apiurl + constant.adminpostcmts+'?user_id='+this.api.decodejwts().userid+'&access_token='+this.api.decodejwts().access_token+'&search_type='+this.search_type+'&search_text='+this.search_value+'&page_no='+this.cmts_default_page+'&post_id='+id;   
		this.api.getRequest(api_url).subscribe(result => {
			this.cmt_results = result;
		},error => {
			this.response_msg = 'Something went wrong please try again later';
            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'top'
            });
		},() => {
			this.comment_count = this.cmt_results.body.count;
			if(this.cmt_results.body.count==0){
				this.norecords = true;
			}
      this.cmt_listing_loader = false;
			this.total_cmts_page = this.cmt_results.body.no_page;
			this.cmt_results.body.result.map(item  => {
				return  item;
			}).forEach(item => {
        var twemoji = require('twemoji');
        item.cmt_text = twemoji.parse(eval('(function(){ return "' + item.cmt_text + '"})()'));
        this.norecords=false; 
        this.cmtsInfo.push(item); 
      });	

			if(this.cmts_default_page===this.total_cmts_page){
				this.loadMorebtn = false;
			}else if(this.cmts_default_page<this.total_cmts_page){
				this.loadMorebtn = true;
			}	
		});
	}

  /**  This function is used for view more comments functionality */
  loadMorecmts(){
    this.cmt_listing_loader = true;
		this.cmts_inc_page += 1;
		this.cmts_default_page = this.cmts_inc_page;
		if(this.cmts_inc_page<=this.total_cmts_page){
			this.loadcmts();
		}
	}


	loadlks(){
    	const id = this.route.snapshot.paramMap.get('id');
		var api_url = constant.apiurl + constant.adminpostlks+'?user_id='+this.api.decodejwts().userid+'&access_token='+this.api.decodejwts().access_token+'&page_no='+this.lks_default_page+'&post_id='+id;   
		this.api.getRequest(api_url).subscribe(result => {
			this.lks_results = result;
		},error => {
			this.response_msg = 'Something went wrong please try again later';
            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'top'
            });
		},() => {

			if(this.lks_results.body.count==0){
				this.lksnorecords = true;
			}
			
			this.total_lks_page = this.lks_results.body.no_page;
			this.lks_results.body.result.map(item  => {
				return  item;
			}).forEach(item => { this.lksnorecords=false; this.lksInfo.push(item); });	

			if(this.lks_default_page===this.total_lks_page){
				this.loadMorelkbtn = false;
			}else if(this.lks_default_page<this.total_lks_page){
				this.loadMorelkbtn = true;
			}	
		});
	}

  /**  This function is used for view more likes functionality */
    loadMorelks(){
		this.lks_inc_page += 1;
		this.lks_default_page = this.lks_inc_page;
		if(this.lks_inc_page<=this.total_lks_page){
			this.loadlks();
		}
	}
  /**  This function using for post active status update functionality */
	updatePoststatus(status) {
		if(status.checked) {
			this.post_status = 'active';
		} else {
			this.post_status = 'inactive';
		}

		const id = this.route.snapshot.paramMap.get('id');
		var href = constant.apiurl+constant.adminpoststatus;
		var params = {
            post_id:id,
            post_type:1,
            post_status:this.post_status,
            comment_id:'',
            user_id: this.api.decodejwts().userid,
            access_token: this.api.decodejwts().access_token
        };

		this.api.postRequest(href,params).subscribe(result => {
			this.restult_status = result;
        },error => {
            this.response_msg = 'Something went wrong please try again later';
            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'top'
            });
        },() => {
            if(this.restult_status.status){
            	this.response_msg = this.restult_status.message;
            }else{
            	this.response_msg = this.restult_status.message;
            }

            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'top'
            });
        });
	}
  /** This function using for comment active status update functionality */
	updateCmtsstatus(cmt_id, status, rm_cls){
    const id = this.route.snapshot.paramMap.get('id');
		var href = constant.apiurl+constant.adminpoststatus;
		var params = {
            post_id:id,
            post_type:2,
            post_status:status,
            comment_id:cmt_id,
            user_id: this.api.decodejwts().userid,
            access_token: this.api.decodejwts().access_token
        };

		this.api.postRequest(href,params).subscribe(result => {
			this.cmt_restult_status = result;
        },error => {
            this.response_msg = 'Something went wrong please try again later';
            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'bottom'
            });
        },() => {
            if(this.cmt_restult_status.status){
              this.document.getElementById('cmt_block_'+cmt_id).classList.remove(rm_cls);
              this.document.getElementById('cmt_block_'+cmt_id).classList.add(status);
            	this.response_msg = this.cmt_restult_status.message;
            }else{
            	this.response_msg = this.cmt_restult_status.message;
            }
            this.snackBar.open(this.response_msg, '', {
              duration: 2000,
              verticalPosition: 'bottom'
            });
        });
	}
  /**  This function used for comments search based data get functionality */
	loadSearchcmt(keyword) {
    this.cmt_listing_loader = true;
		this.loadMorebtn = false;
		this.cmts_default_page = 1;
		this.cmts_inc_page = 1;
		if (keyword.target.value) {
			this.cmtsInfo = [];
			this.search_value = keyword.target.value;
			this.loadcmts();
		} else {
			this.search_type = 'all';
			this.search_selected = 'all';
			this.cmtsInfo = [];
			this.search_value = '';
			this.loadcmts();
		}
	}
  /** This function used for comments enable & disable functionality */
  loadSearchcmtaction() {
    this.cmt_listing_loader = true;
    this.loadMorebtn = false;
    this.cmts_default_page = 1;
    this.cmts_inc_page = 1;
    if (this.search_text.length > 0) {
      this.cmtsInfo = [];
      this.search_value = this.search_text;
      this.loadcmts();
    }else{
      this.search_type = 'all';
      this.search_selected = 'all';
      this.cmtsInfo = [];
      this.search_value = '';
      this.loadcmts();
    }
  }
  /**  When comment type onChange event occur, this function will be trigger */
	onChangeType(values){
    this.cmt_listing_loader = true;
    this.search_type = values;
    this.search_selected = values;
    this.cmtsInfo = [];
    this.search_value = this.search_text;
    this.loadcmts();
	}

}
