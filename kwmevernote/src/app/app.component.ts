import { Component } from '@angular/core';
import { RouterLink, RouterLinkActive, RouterOutlet } from '@angular/router';
import { Note } from '../shared/note';
import { NoteListComponent } from './note-list/note-list.component';
import { NoteDetailsComponent } from './note-details/note-details.component';
import { ListListComponent } from './list-list/list-list.component';
import { TaglistComponent } from './taglist/taglist.component';


//import { NoteStoreService } from "../../shared/note-store.service";



@Component({
selector: 'app-root',
standalone: true,
imports: [RouterOutlet, RouterLink, RouterLinkActive, NoteListComponent , NoteDetailsComponent, ListListComponent],
templateUrl: './app.component.html'
})
export class AppComponent  {



listOn = true;
detailsOn = false;
//note: Note | undefined;
//title = 'kwmevernote';


showList() {
    this.listOn = true;
    this.detailsOn = false;
  }

  /*showDetails(note: Note) {
    this.note = note;
   this.listOn = false;
    this.detailsOn = true;
  }*/
}
