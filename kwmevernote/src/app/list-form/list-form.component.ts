import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { List } from "../../shared/list";
import { ListStoreService } from '../../shared/list-store.service';
import { ListFormErrorMessages, ErrorMessage } from './list-form-error-messages';
import { FormArray, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { ListFactory } from '../../shared/list-factory';


@Component({
  selector: 'app-list-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './list-form.component.html',
  styles: ``
})
export class ListFormComponent implements OnInit{
listForm: FormGroup;
list = ListFactory.empty();
errors: { [key: string]: string } = {};
isUpdatingList = false;

constructor(
    private fb: FormBuilder,
    private es: ListStoreService,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.listForm = this.fb.group({});
  }

ngOnInit() {
    const id = this.route.snapshot.params['id'];
    if (id) {
      this.isUpdatingList = true;
      this.es.getOneList(id).subscribe((list: List) => {
        this.list = list;
        this.initList();
      });
    }
    this.initList();
  }

initList() {
    this.listForm = this.fb.group({
      id: this.list.id,
      user_id: [this.list.user_id, Validators.required],
      name: [this.list.name, Validators.required],
      is_public: [this.list.is_public, Validators.required]
    });

    this.listForm.statusChanges.subscribe(() => this.updateErrorMessages());
  }

goBack() {
    this.router.navigate(['/listList']);
  }

  submitForm() {
    const list: List = ListFactory.fromObject(this.listForm.value);

    if (this.isUpdatingList) {
      this.es.updateList(list).subscribe((res: any) => {
        console.log('Update response:', res); // Log the response
        // Navigation zur Übersicht nach erfolgreichem Update
        this.router.navigate(['/listList']);
      });
    } else {
      list.user_id = 1; // just for testing
      this.es.createList(list).subscribe((res: any) => {
        this.list = ListFactory.empty();
        this.listForm.reset(ListFactory.empty());
        this.router.navigate(['/listList']);
      });
    }
  }

updateErrorMessages() {
    this.errors = {};
    // Assuming ListFormErrorMessages is properly imported and defined
    for (const message of ListFormErrorMessages) {
      const control = this.listForm.get(message.forControl);
      if (control && control.dirty && control.invalid && control.errors && control.errors[message.forValidator] && !this.errors[message.forControl]) {
        this.errors[message.forControl] = message.text;
      }
    }
  }
}
