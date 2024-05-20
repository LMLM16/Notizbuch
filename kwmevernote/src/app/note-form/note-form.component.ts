import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { NoteStoreService } from '../../shared/note-store.service';
import { Note } from '../../shared/note';
import { NoteFactory } from '../../shared/note-factory';
import { NoteFormErrorMessages } from './note-form-error-messages';

@Component({
selector: 'app-note-form',
standalone: true,
imports: [CommonModule, ReactiveFormsModule],
templateUrl: './note-form.component.html',
styles: ``
})

export class NoteFormComponent implements OnInit {

noteForm: FormGroup;
note: Note = NoteFactory.empty();
errors: { [key: string]: string } = {};
isUpdatingNote: boolean = false;

constructor(
    private fb: FormBuilder,
    private es: NoteStoreService,
    private route: ActivatedRoute,
    private router: Router
  ) {
this.noteForm = this.fb.group({});
}

initForm() {
    this.noteForm = this.fb.group({
      id: [ this.note.id, Validators.required],
      user_id: [this.note.user_id, Validators.required],
      title: [this.note.title, Validators.required],
      content: [this.note.content, Validators.required],
      rating: [this.note.rating, Validators.required],
      list_id: [this.note.list_id, Validators.required]

    });

    this.noteForm.statusChanges.subscribe(() => this.updateErrorMessages());
  }

  ngOnInit() {
    this.initForm();
    const id = this.route.snapshot.params['id'];
    console.log('Route ID:', id);
    if (id) {
      this.isUpdatingNote = true;
      this.es.getOneNote(id).subscribe(
        (note: Note) => {
          console.log('Fetched note:', note);
          this.note = note;
          if (this.note.id) {
            this.noteForm.patchValue({
              user_id: this.note.user_id,
              title: this.note.title,
              content: this.note.content,
              rating: this.note.rating,
              list_id: this.note.list_id
            });
          } else {
            console.error('Fetched note does not have an id:', note);
          }
        },
        (error) => {
          console.error('Error fetching note:', error);
        }
      );
    }
  }



  submitForm() {
console.log(this.noteForm.value);
    const note: Note = NoteFactory.fromObject(this.noteForm.value);

    if (this.isUpdatingNote) {
      note.id = this.note.id; // Set the ID for the update
      console.log('Updating note:', note); // Add console log for debugging
      this.es.updateNote(note).subscribe(
        (res: any) => {
          console.log('Update response:', res); // Log the response
          this.router.navigate(['/notes', note.id]);
        },
        (error: any) => {
          console.error('Error updating the note:', error); // Log the error
          alert('Fehler beim Aktualisieren der Notiz: ' + error.message);
        }
      );
    } else {
      note.user_id = 1; // just for testing
      note.list_id = this.noteForm.value.list_id; // Ensure list_id is set
      console.log('Creating note:', note); // Add console log for debugging
      this.es.createNote(note).subscribe(
        (res: any) => {
          console.log('Create response:', res); // Log the response
          this.note = NoteFactory.empty();
          this.noteForm.reset(NoteFactory.empty());
          this.router.navigate(['listList']);
        },
        (error: any) => {
          console.error('Error creating the note:', error); // Log the error
          alert('Fehler beim Erstellen der Notiz: ' + error.message);
        }
      );
    }
  }

deleteNote() {
    if (confirm('Möchtest du diese Notiz wirklich löschen?')) {
      this.es.deleteNote(this.note.id).subscribe(
        (res: any) => {
          console.log('Delete response:', res); // Log the response
          this.router.navigate(['listList']);
        },
        (error: any) => {
          console.error('Error deleting the note:', error); // Log the error
          alert('Fehler beim Löschen der Notiz: ' + error.message);
        }
      );
    }
  }

  updateErrorMessages() {
    this.errors = {};
    for (const message of NoteFormErrorMessages) {
      const control = this.noteForm.get(message.forControl);
      if (control && control.dirty && control.invalid && control.errors && control.errors[message.forValidator] && !this.errors[message.forControl]) {
        this.errors[message.forControl] = message.text;
      }
    }
  }

//falls list id gefunden wird dann zur notedetails ansonsten listlist.
  goBack() {
    if (this.note.list_id) {
      this.router.navigate(['/noteLists', this.note.list_id]);
    } else {
      this.router.navigate(['/listList']);
    }
  }

}
