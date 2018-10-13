/*
 * Page : 404 Not Found
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : bsetec
 */
import { Component, OnInit } from '@angular/core';
import { BaseComponent } from '../../base/base.component';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { AuthService } from '../../../services/auth/auth.service';

@Component({
  selector: 'app-notfound',
  templateUrl: './notfound.component.html',
  styleUrls: ['./notfound.component.css']
})
export class NotfoundComponent implements OnInit {
  page_access:boolean = false;
  constructor(private router: Router, private route: ActivatedRoute, private app: BaseComponent, private titleService: Title, public auth: AuthService) { }

  ngOnInit() {
    if (this.auth.isAdmin) {
        this.page_access = true;      
    }
  }

   ngAfterViewChecked(){
    if (this.app.page_app_name != '' && typeof this.app.page_app_name != 'undefined') {
      this.titleService.setTitle( this.app.page_app_name+' | 404 Not Found' );
    }
  }

}
