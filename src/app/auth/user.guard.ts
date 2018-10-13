/*
 * File : user.guard.ts
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { AuthService } from '../services/auth/auth.service';
import { UserService } from '../services/sync/user.service';

@Injectable()
export class UserGuard implements CanActivate {

    constructor(
    private auth: AuthService,
    private router: Router,
    private syncVar: UserService
  ) {}
  /** It is used to check the user is logged or not */
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
    if (!this.auth.isAdmin) {
        this.router.navigate(['/login']);
        this.syncVar.sendMessage('Access Denied');
        return false;
    }
    return true;
  }
}
