import { List } from './list';
import { Note } from './note';
import { User } from './user';

export class ListFactory {
static empty(): List {
    return new List(0, 0, '', true, [], []);
  }

  static fromObject(rawList: any): List {
    return new List(
      rawList.id,
      rawList.user_id,
      rawList.name,
      rawList.is_public,
      rawList.user,
      rawList.notes
    );
  }
}
