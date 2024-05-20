import {Note} from "./note";
import {User} from "./user";

export class List {
  constructor(
  public id: number,
  public user_id:number,
  public name: string,
  public is_public: boolean,
  public user: User[],
  public notes: Note[],
  ){
}
}

