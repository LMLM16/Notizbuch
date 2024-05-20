import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Note } from "../../shared/note";
import { User } from "../../shared/user";
import { NoteDetailsComponent } from "../note-details/note-details.component";
import { NoteStoreService } from "../../shared/note-store.service";

@Component({
selector: 'app-note-list',
standalone: true,
imports: [CommonModule, NoteDetailsComponent],
templateUrl: './note-list.component.html',
styles: ``
})

export class NoteListComponent implements OnInit {

notes: Note[] = [];

constructor(private es: NoteStoreService){
}

ngOnInit() {
this.es.getAllNotes().subscribe(res => this.notes = res);
}

showDetails(notes: Note) { }

}

