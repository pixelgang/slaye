import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MailtemplateComponent } from './mailtemplate.component';

describe('MailtemplateComponent', () => {
  let component: MailtemplateComponent;
  let fixture: ComponentFixture<MailtemplateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MailtemplateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MailtemplateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
