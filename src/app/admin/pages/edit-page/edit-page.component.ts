/*
 * Page : CMS Edit Page
 * Use: This page only used for cms page edit functionality
 * Functionality :
 *  >> Create the cms page edit form
 *  >> Form input field email validation
 *  >> After successful form submission redirect to cms list page
 * Created Date : 09/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { FormBuilder, FormGroup ,Validators, FormControl, DefaultValueAccessor, FormArray } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';
import { constant } from '../../../../data/constant';
import { Title, Meta, DOCUMENT, DomSanitizer } from '@angular/platform-browser';
import { environment } from '.././../../../environments/environment';

@Component({
    selector: 'app-edit-page',
    templateUrl: './edit-page.component.html',
    styleUrls: ['./edit-page.component.css']
})

export class EditPageComponent implements OnInit {

    cmseditForm: FormGroup; // Declare the form object for forgot password form
    isbuttondisable:boolean = false; // This varaible used for form submit button disable option
    // Variable declaration for success & error message motificcation - start
    ismessage:boolean = false;
    is_success:boolean = false;
    errormessage:string = "";
    // Variable declaration for success & error message motificcation - end
    data:any;
    gp_data:any;
    result = [];
    gp_result = [];
    selected_group_value:any;
    answer_value:number;
    result_to_form:any;
    constructor(public sanitizer:DomSanitizer, public formbuilder:FormBuilder, private api : ApiService, private router:Router, @Inject(DOCUMENT) private document: HTMLDocument,
        private titleService: Title, 
        private route:ActivatedRoute ) {
        // Declare the cms page form and field validation
        this.cmseditForm = formbuilder.group({
            'cms_title' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
            'cms_desc' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
            'cms_slug' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
            'cms_meta_desc' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
            'cms_meta_key' : [null, Validators.compose([Validators.required, this.noWhitespaceValidator])],
            'cms_status' : [null, Validators.compose([Validators.required])]              
        });
    }

    noWhitespaceValidator(control: FormControl) {
        let isWhitespace = (control.value || '').trim().length === 0;
        let isValid = !isWhitespace;
        return isValid ? null : { 'whitespace': true }
    }

    ngOnInit() {
        this.getEditinfos();
    }
    /** This function used for prepopulate the select cms page details */
    getEditinfos(){
        const id = this.route.snapshot.paramMap.get('id');
        var href = constant.apiurl+constant.admincmsaction;
        var params = {
            action_type:2,
            id:id,
            user_id: this.api.decodejwts().userid,
            access_token: this.api.decodejwts().access_token
        };
        this.api.postRequest(href,params).subscribe(result => {
            this.result_to_form = result;
        },error => {
            this.errormessage = error.error.non_field_errors["0"];
            this.showError();
        },() => {
            this.cmseditForm.patchValue({
                'cms_title' : this.result_to_form.data['0'].title,
                'cms_desc' : this.result_to_form.data['0'].desc,
                'cms_slug' : this.result_to_form.data['0'].alias,
                'cms_meta_desc' : this.result_to_form.data['0'].meta_desc,
                'cms_meta_key' : this.result_to_form.data['0'].meta_key,
                'cms_status' : this.result_to_form.data['0'].status
            });
        });
    }
    /** This function is used for cms page form submission, form validation & success - error message notification display */
    cmseditFormSubmit(formData) {
    	if(this.cmseditForm.valid) {
    		const id = this.route.snapshot.paramMap.get('id');
    		var slug = formData.cms_slug.toLowerCase().trim();
    		slug = slug.replace(/[^a-z0-9\s-]/g, '');
    		slug = slug.replace(/[\s-]+/g, '-');
    		var href = constant.apiurl+constant.admincmsaction;
    		var params = {
                action_type:4,
                id:id,
                title: formData.cms_title.trim(),
                alias: slug,
                desc: formData.cms_desc.trim(),
                meta_desc: formData.cms_meta_desc.trim(),
                meta_key: formData.cms_meta_key.trim(),
                status:formData.cms_status,
                user_id: this.api.decodejwts().userid,
                access_token: this.api.decodejwts().access_token
            };
            // Send submitted cms edit page form data to the api & get response
            this.api.postRequest(href,params).subscribe(result => {
            },error => {
                this.errormessage = error.error.non_field_errors["0"];
                this.showError();
            },() => {
                this.showSuccess();
            });
            
        } else {
            // In this part of code show/hide the error message and disable/enable the form submit button
            this.getFormMessage();
            this.showError();
        }
    }

    getFormMessage () {
        // In this part of code using for form validation notification
    	if(this.cmseditForm.controls['cms_title'].hasError('required') || this.cmseditForm.controls['cms_desc'].hasError('required') || this.cmseditForm.controls['cms_slug'].hasError('required') || this.cmseditForm.controls['cms_meta_desc'].hasError('required') || this.cmseditForm.controls['cms_meta_key'].hasError('required') || this.cmseditForm.controls['cms_guest'].hasError('required') || this.cmseditForm.controls['cms_status'].hasError('required') || this.cmseditForm.controls['cms_title'].hasError('whitespace') || this.cmseditForm.controls['cms_desc'].hasError('whitespace') || this.cmseditForm.controls['cms_slug'].hasError('whitespace') || this.cmseditForm.controls['cms_meta_desc'].hasError('whitespace') || this.cmseditForm.controls['cms_meta_key'].hasError('whitespace')) {
    		this.errormessage =  'Fields are required';
    	}
    }

    showSuccess() {
    	this.is_success = true;
    	setTimeout(() => {
    		this.router.navigate(['/admin/pages']);
    		this.is_success = false;
    	}, 1000);
    }

    showError() {
    	this.isbuttondisable = true;
    	this.ismessage = true;          
    	setTimeout(() => {
    		this.ismessage = false;
    		this.isbuttondisable = false;
    	}, 2000);       
    }

}
