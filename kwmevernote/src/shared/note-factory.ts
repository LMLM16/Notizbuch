import { List } from './list';
import { Note } from './note';
import { User } from './user';

export class NoteFactory {
static empty(): Note {
    return new Note(0, 0, '', '', [], 0, [],'', [], 0, new Date());
  }

  static fromObject(rawNote: any): Note {
    return new Note(
      rawNote.id,
      rawNote.user_id,
      rawNote.title,
      rawNote.content,
      rawNote.user,
      rawNote.rating,
      rawNote.subtitle,
      rawNote.images,
      rawNote.list_id,
      typeof(rawNote.published) === 'string' ? new Date(rawNote.published) : rawNote.published
    );
  }
}
