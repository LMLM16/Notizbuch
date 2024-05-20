import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { NgModule } from '@angular/core';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { List } from "../../shared/list";
import { ListStoreService } from '../../shared/list-store.service';
import { TaglistComponent } from '../taglist/taglist.component';

@Component({
  selector: 'app-list-list',
  standalone: true,
  imports: [CommonModule,TaglistComponent],
  templateUrl: './list-list.component.html',
  styles: ``
})

export class ListListComponent implements OnInit {
lists: List[] = [];

constructor(private es: ListStoreService, private router: Router) {}

  ngOnInit() {
    this.es.getAllLists().subscribe(res => this.lists = res);
  }

  viewListDetails(id: number) {
    this.router.navigate(['/Lists', id]);
  }

editList(id: number): void {
    this.router.navigate(['/admin/editList', id]);
  }

navigateToCreateList() {
    this.router.navigate(['/admin/createList']);
  }

navigateToToDos() {
    this.router.navigate(['/todos']);
  }

goBack() {
    this.router.navigate(['/listList']);
  }

deleteList(id: number): void {
    this.es.deleteList(id).subscribe(() => {
      this.lists = this.lists.filter(list => list.id !== id);
    });
  }

}
