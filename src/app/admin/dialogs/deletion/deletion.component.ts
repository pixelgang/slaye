/*
 * Component :  Delete component
 * Use: CMS page delete functionality
 * Created Date : 09/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

import { ApiService } from '../../../services/api/api.service';
import { constant } from '../../../../data/constant';

@Component({
  selector: 'app-deletion',
  templateUrl: './deletion.component.html',
  styleUrls: ['./deletion.component.css']
})
export class DeletionComponent implements OnInit {

  constructor(
    @Inject(MAT_DIALOG_DATA) public data: any,
    public dialogRef: MatDialogRef<DeletionComponent>,
    public api : ApiService
    ) { }

  ngOnInit() {
  }

  onNoClick(): void {
    this.dialogRef.close();
  }
  /**  This function used to delete page confirmation window screen open & make page delete functionality */
  confirmDelete(): void {
    var actionURL;
    var params;
    var userID = this.api.decodejwts().userid;
    var accessToken = this.api.decodejwts().access_token;

    if(this.data.from == 'page') {
      actionURL = constant.admincmsaction;
      params    = {
        action_type:3,
        id:this.data.id,
        user_id: this.api.decodejwts().userid,
        access_token: this.api.decodejwts().access_token
      };
    }
    
    const href = constant.apiurl+actionURL;    
    this.api.postRequest(href,params).subscribe(
      data => {
      }
      );    
  }

}
