import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FantasticComponent } from './fantastic.component';

describe('FantasticComponent', () => {
  let component: FantasticComponent;
  let fixture: ComponentFixture<FantasticComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FantasticComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FantasticComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
