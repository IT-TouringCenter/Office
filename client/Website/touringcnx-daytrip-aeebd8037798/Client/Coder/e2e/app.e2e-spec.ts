import { Angular4Demo1Page } from './app.po';

describe('angular4-demo1 App', () => {
  let page: Angular4Demo1Page;

  beforeEach(() => {
    page = new Angular4Demo1Page();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!');
  });
});
