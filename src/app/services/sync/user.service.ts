/*
 * File : user.service.ts
 * Use: Header and alert message service
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
import { ApiService } from '../../services/api/api.service';
import { constant } from '../../../data/constant';
@Injectable()
export class UserService {
  private headerinfo   = new BehaviorSubject<string>('');
  private alertMessage = new BehaviorSubject<string>('');

  headerinfoAlert   = this.headerinfo.asObservable();
  globalAlert       = this.alertMessage.asObservable();
  constructor(private apiService: ApiService) {
  }
  
  /** It is used to change the header information */
  headerinfoAlerts(id) {
    this.headerinfo.next(id);
  }

  /** It is used to set the alert message */
  sendMessage(msg) {
     this.alertMessage.next(msg);
  }

}
