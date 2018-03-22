import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router'; // import routing
import { HashLocationStrategy, LocationStrategy } from '@angular/common'; // Prevent refresh page.

// map component
import { AgmCoreModule } from '@agm/core';

import { AppComponent } from './app.component';

// preloader
// import {NgxFancyPreloaderModule } from 'ngx-fancy-preloader';

// services
import { DataService } from './services/data.service';

// commond component
import { FooterComponent } from './components/footer/footer.component';
import { ComponentComponent } from './component/component.component';

// test component
import { UserComponent } from './component/user/user.component';
import { AboutComponent } from './component/about/about.component';

// market component
import { MarketComponent } from './components/market/market.component';
import { ServiceComponent } from './components/market/service/service.component';
import { TripsComponent } from './components/market/trips/trips.component';
import { RecommendComponent } from './components/market/trips/recommend/recommend.component';
import { AdventureComponent } from './components/market/trips/adventure/adventure.component';
import { ElephantComponent } from './components/market/trips/elephant/elephant.component';
import { CultureComponent } from './components/market/trips/culture/culture.component';
import { SightseeingComponent } from './components/market/trips/sightseeing/sightseeing.component';
import { VideoComponent } from './components/market/video/video.component';
import { FeedbackComponent } from './components/market/feedback/feedback.component';
import { PackageComponent } from './components/market/package/package.component';
import { TeamComponent } from './components/market/team/team.component';
import { SubscribeComponent } from './components/market/subscribe/subscribe.component';
import { QuestionComponent } from './components/market/question/question.component';
import { HeaderComponent } from './components/market/header/header.component';

// fantastic component.
import { FantasticComponent } from './components/fantastic/fantastic.component';
import { TriptemplateComponent } from './components/fantastic/triptemplate/triptemplate.component';
import { IntroComponent } from './components/fantastic/intro/intro.component';
import { TripComponent } from './components/fantastic/trip/trip.component';
import { AccessoryComponent } from './components/fantastic/accessory/accessory.component';
import { PriceComponent } from './components/fantastic/price/price.component';
import { GalleryComponent } from './components/fantastic/gallery/gallery.component';
import { PreloaderComponent } from './components/preloader/preloader.component';
import { MapComponent } from './components/map/map.component';

// scroll
import { ScrollToModule} from 'ng2-scroll-to';
import { SearchComponent } from './components/search/search.component';
import { SearchHeaderComponent } from './components/search/search-header/search-header.component';
import { PaggingComponent } from './components/search/pagging/pagging.component';
import { AllComponent } from './components/search/all/all.component';
import { SearchVideoComponent } from './components/search/search-video/search-video.component';
import { SearchGalleryComponent } from './components/search/search-gallery/search-gallery.component';

const appRoutes: Routes = [
  {path: '', component: MarketComponent, pathMatch: 'full'},
  {path: 'about', component: AboutComponent},
  {path: 'search', component: SearchComponent},
  {path: 'fantastic',  component: FantasticComponent}
  //https://stackoverflow.com/questions/43657030/error-cannot-match-any-routes-url-segment-angular-2
];

@NgModule({
  declarations: [
    AppComponent,
    UserComponent,
    AboutComponent,
    HeaderComponent,
    MarketComponent,
    ServiceComponent,
    TripsComponent,
    RecommendComponent,
    AdventureComponent,
    ElephantComponent,
    CultureComponent,
    SightseeingComponent,
    VideoComponent,
    FeedbackComponent,
    PackageComponent,
    TeamComponent,
    SubscribeComponent,
    QuestionComponent,
    FooterComponent,
    ComponentComponent,
    FantasticComponent,
    TriptemplateComponent,
    IntroComponent,
    TripComponent,
    AccessoryComponent,
    PriceComponent,
    GalleryComponent,
    PreloaderComponent,
    MapComponent,
    SearchComponent,
    SearchHeaderComponent,
    PaggingComponent,
    AllComponent,
    SearchVideoComponent,
    SearchGalleryComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    // https://stackoverflow.com/questions/35284988/angular-2-404-error-occur-when-i-refresh-through-browser
    RouterModule.forRoot(appRoutes, {useHash: true}),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyBWy_RhYudyI9DW3_Mp3zjgCXHmtfWbssQ'
    }),
    ScrollToModule.forRoot()
  ],
  providers: [
    DataService,
    {provide: LocationStrategy, useClass: HashLocationStrategy},
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
