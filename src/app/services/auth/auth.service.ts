/*
 * File : auth.service.ts
 * Use: User authentication service 
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Injectable } from '@angular/core';
import { ApiService } from '../../services/api/api.service';
@Injectable()

export class AuthService {

  constructor(private apiService: ApiService) { }

  /** To check the user is admin or not */
  get isAdmin() {
    if(this.apiService.decodejwts().userid) {
      if(this.apiService.decodejwts().role=='1') {
        return true;
      }
    }
    return false;
  }

}
