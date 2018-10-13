/*
 * Component :  Footer component
 * Use: Footer functionality
 * Created Date : 09/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {
  years:number;
  constructor() { }

  ngOnInit() {
  	this.years = (new Date()).getFullYear();
  }

}
