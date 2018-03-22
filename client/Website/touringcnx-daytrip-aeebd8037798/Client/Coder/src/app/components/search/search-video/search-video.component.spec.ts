import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SearchVdoComponent } from './search-vdo.component';

describe('SearchVdoComponent', () => {
  let component: SearchVdoComponent;
  let fixture: ComponentFixture<SearchVdoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SearchVdoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SearchVdoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
