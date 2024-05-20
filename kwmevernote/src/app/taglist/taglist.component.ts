import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Tag } from "../../shared/tag";
import { Note } from "../../shared/note";
import { User } from "../../shared/user";
import { TagStoreService } from "../../shared/tag-store.service";


@Component({
  selector: 'app-taglist',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './taglist.component.html',
  styles: ``
})
export class TaglistComponent {

tags: Tag[] = [];

constructor(private es: TagStoreService){
}

ngOnInit(): void {
    this.loadTags();
  }

loadTags(): void {
    this.es.getAllTags().subscribe(
      (data: Tag[]) => {
        this.tags = data;
      },
      (error) => {
        console.error('Fehler beim Abrufen der Tags:', error);
      }
    );
  }

}
