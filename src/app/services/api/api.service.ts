/*
 * File : api.service.ts
 * Use: API call service library
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { HttpHeaders, HttpResponse, HttpXsrfTokenExtractor } from '@angular/common/http';
import { Observable } from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
import { Setting } from '../../../model/setting'; // singleton setting model

const httpOptions = {
  headers: new HttpHeaders({ 'Access-Control-Allow-Origin': '*', 'Content-Type': 'application/json' })
};

@Injectable()
export class ApiService {
  settingSingleton: Setting;
  respDataSetting:any;
  constructor(private http: HttpClient, private tokenExtractor: HttpXsrfTokenExtractor) { }

  public get authHeader(): string {
    return `Bearer ${localStorage.getItem('instasocial_token')}`;
  }

  /** To set the authorization token */
  setHeaders() {
    if (this.decodejwts()) {
      return {
        headers: new HttpHeaders().set('Authorization', this.authHeader)
      };
    } else {
      return {};
    }
  }
  /** API call for get request */
  getRequest(url: string) {
    const options = {};
    options['observe'] = 'response';
    if (this.decodejwts()) {
      options['headers'] = new HttpHeaders().set('Authorization', this.authHeader);
    }
    return this.http.get(url, options).map(data => {
      return data;
    });
  }
  /** API call for post request */
  postRequest(url: string, params: any) {
    return this.http.post(url, params, this.setHeaders()).map(data => {
      return data;
    });
  }
  /** API call for put request */
  putRequest(url: string, params: any) {
    return this.http.put(url, params, this.setHeaders()).map(data => {
      return data;
    });
  }
  /** API call for delete request */
  deleteRequest(url: string, params: any) {
    const options = {};
    options['body'] = params;
    options['observe'] = 'response';
    if (this.decodejwts()) {
      options['headers'] = new HttpHeaders().set('Authorization', this.authHeader);
    }
    return this.http.delete(url, options).map(data => {
      return data;
    });
  }
  /** It is used to decode the jwt token values */
  decodejwts() {
    const signedToken = localStorage.getItem('instasocial_token');
    if (signedToken != null) {
      const base64Url = signedToken.split('.')[1];
      const base64 = base64Url.replace('-', '+').replace('_', '/');
      return JSON.parse(atob(base64));
    } else {
      return false;
    }
  }

  /** it is used to set the site settings data using singleton */
  init(url: string, call = '') {
    if (this.settingSingleton && call === '') {
      return Observable.of(this.settingSingleton);
    } else {
        return this.http.get(url).map(response => {
             this.respDataSetting = response;
             return this.settingSingleton = this.respDataSetting;
          });
    }
  }
 
}
