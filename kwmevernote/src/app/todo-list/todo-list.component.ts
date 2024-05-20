import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Todo } from '../../shared/todo';
import { TodoServiceService } from '../../shared/todo-service.service';

@Component({
selector: 'app-todo-list',
standalone: true,
imports: [CommonModule, HttpClientModule],
templateUrl: './todo-list.component.html',
styles: [``]
})
export class TodoListComponent implements OnInit {
todos: Todo[] = []; // Correctly define as an array of Todo

constructor(
private route: ActivatedRoute,
private router: Router,
private todoService: TodoServiceService) { }

  ngOnInit(): void {
    this.loadTodos();
  }

  loadTodos(): void {
    this.todoService.getAllTodos().subscribe(
      (data: Todo[]) => {
        this.todos = data;
      },
      (error) => {
        console.error('Error fetching todos:', error);
      }
    );
  }

goBack() {
    this.router.navigate(['/listList']);
  }
}
