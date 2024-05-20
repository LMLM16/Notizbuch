import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NoteStoreService } from "../../shared/note-store.service";
import { TagStoreService } from "../../shared/tag-store.service";
import { Tag } from '../../shared/tag';

@Component({
selector: 'p.app-note-tags',
standalone: true,
imports: [CommonModule],
templateUrl: './note-tags.component.html',
})

export class NoteTagsComponent implements OnInit {
tags: Tag[] = [];
@Input() id!: number;

constructor(
    private route: ActivatedRoute,
    private router: Router,
    private es: NoteStoreService
  ) { }

  ngOnInit() {
    if (this.id) {
      this.es.getNoteTags(this.id).subscribe(
        (tags: Tag[]) => {
          this.tags = tags;
        },
        error => {
          console.error('Error fetching tags:', error);
        }
      );
    }
  }

  goBack() {
    this.router.navigate(['/notes', this.id]);
  }
}
