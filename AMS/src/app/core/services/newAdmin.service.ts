import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions} from '@angular/http';
import {environment} from "../../../environments/environment";

@Injectable()
export class NewAdmin {


    constructor(private http: Http){}


    newMember(data: {username: string, password: string, email: string, role: string }){
        let headers = new Headers() ; 
        headers.append("Access-Control-Allow-Origin","http://localhost:4200/home/new-admin") ; 
        let options = new RequestOptions(); 
        options.headers = headers ; 
        return this.http.post(environment.apiPath+"admin",data,options);
    }


   


}