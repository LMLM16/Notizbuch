import { Component, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { Note } from '../../shared/note';
import { Tag } from '../../shared/tag';
import { List } from '../../shared/list';
import { NoteStoreService } from "../../shared/note-store.service";
import { ListStoreService } from "../../shared/list-store.service";


@Component({
selector: 'a.app-note-details',
standalone: true,
imports: [CommonModule, ],
templateUrl: './note-details.component.html',
})

export class NoteDetailsComponent {
@Input() note:Note | undefined;
@Input() list: List | undefined;
noteTags: { [key: number]: Tag[] } = {};
listId: number | undefined;
tags: Tag[] = [];

constructor(
    private route: ActivatedRoute,
    private router: Router,
    private es: NoteStoreService,
    private listStoreService: ListStoreService

  ) {}

  ngOnInit() {
    this.route.paramMap.subscribe((params) => {
      const listId = Number(params.get('Id'));
      console.log('List ID from route:', listId);
      if (listId) {
        this.listStoreService.getOneList(listId).subscribe(
          (list: List) => {
            this.list = list;
            console.log('List:', this.list);
            if (this.list && this.list.notes) {
              this.list.notes.forEach((note) => {
                this.es.getNoteTags(note.id).subscribe(
                  (tags: Tag[]) => {
                    this.noteTags[note.id] = Array.isArray(tags) ? tags : [];
                  },
                  (error) => {
                    console.error(`Error fetching tags for note ${note.id}:`, error);
                    this.noteTags[note.id] = [];
                  }
                );
              });
            }
          },
          (error) => {
            console.error('Error fetching list:', error);
          }
        );
      }
    });
  }

editNote(id: number): void {
    this.router.navigate(['/admin/editNote', id]);
  }

goBack() {
    this.router.navigate(['/listList']);
  }

navigateToCreateNote() {
    this.router.navigate(['/admin/createNote']);
  }

deleteNote(id: number): void {
    if (confirm('Möchtest du diese Notiz wirklich löschen?')) {
      this.es.deleteNote(id).subscribe(
        res => {
          console.log('Delete response:', res);
          this.router.navigate(['listList']);
        },
        error => {
          console.error('Error deleting the note:', error);
          alert('Fehler beim Löschen der Notiz: ' + error.message);
        }
      );
    }
  }

getTags(noteId: number) {
  this.es.getNoteTags(noteId).subscribe(
    (tags: Tag[]) => {
      this.noteTags[noteId] = Array.isArray(tags) ? tags : []; // Stelle sicher, dass es ein Array ist
    },
    error => {
      console.error('Error fetching tags:', error);
      this.noteTags[noteId] = []; // Setze ein leeres Array bei Fehlern
    }
  );
}

}


