import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { TestService } from './services/test.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  title = 'front';
  msg: Observable<any> = this.test.test();
  constructor(private test: TestService){}

  ngOnInit(){ }
}
