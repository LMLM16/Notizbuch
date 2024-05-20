import { Note } from "./note";
export { Note } from "./note";
import { Tag } from "./tag";
export { Tag } from "./tag";
import { List } from "./list";
export { List } from "./list";
import { User } from "./user";
export { User } from "./user";


export class Todo {
constructor(
public id: number,
public title: string,
public description?: string,
public note_id?: number,
public user_id?: number,
public due_date?: Date,
public is_done?: boolean,
public list_id?: number,
public tags?: Tag[]
) {}
}

