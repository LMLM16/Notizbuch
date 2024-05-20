import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TodoTagsComponent } from './todo-tags.component';

describe('TodoTagsComponent', () => {
  let component: TodoTagsComponent;
  let fixture: ComponentFixture<TodoTagsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TodoTagsComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(TodoTagsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
