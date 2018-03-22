import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TriptemplateComponent } from './triptemplate.component';

describe('TriptemplateComponent', () => {
  let component: TriptemplateComponent;
  let fixture: ComponentFixture<TriptemplateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TriptemplateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TriptemplateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
