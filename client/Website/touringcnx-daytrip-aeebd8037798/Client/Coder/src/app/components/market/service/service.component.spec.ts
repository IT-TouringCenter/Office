import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TcserviceComponent } from './tcservice.component';

describe('TcserviceComponent', () => {
  let component: TcserviceComponent;
  let fixture: ComponentFixture<TcserviceComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TcserviceComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TcserviceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
