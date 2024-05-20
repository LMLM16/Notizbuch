import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { NoteListComponent } from "./note-list/note-list.component";
import { ListListComponent } from "./list-list/list-list.component";
import { NoteDetailsComponent } from "./note-details/note-details.component";
import { ListFormComponent } from "./list-form/list-form.component";
import { NoteFormComponent } from "./note-form/note-form.component";
import { TodoListComponent } from "./todo-list/todo-list.component";
import { NoteTagsComponent } from "./note-tags/note-tags.component";
//import { LoginComponent } from "./login/login.component";



//wenn neue komponente hier dann rauch rein, da werd ich hindirected
export const routes: Routes = [
{ path: '', redirectTo: 'listList', pathMatch: 'full' },
{ path: 'listList', component: ListListComponent },
//{ path: 'noteLists', component: NoteListComponent },
{ path: 'Lists/:Id', component: NoteDetailsComponent },
{ path: 'notes/:Id', component: NoteDetailsComponent },
{ path: 'noteLists/:listId', component: NoteDetailsComponent },
{ path: 'admin/createList', component: ListFormComponent },
{ path: 'admin/editList/:id', component: ListFormComponent },
{ path: 'admin/editNote/:id', component: NoteFormComponent },
{ path: 'admin/createNote', component: NoteFormComponent },
{ path: 'todos', component: TodoListComponent },
//{ path: 'auth/login', component: LoginComponent}
];

@NgModule({
imports:[
RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
