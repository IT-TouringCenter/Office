import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SearchGalleryComponent } from './search-gallery.component';

describe('SearchGalleryComponent', () => {
  let component: SearchGalleryComponent;
  let fixture: ComponentFixture<SearchGalleryComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SearchGalleryComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SearchGalleryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
