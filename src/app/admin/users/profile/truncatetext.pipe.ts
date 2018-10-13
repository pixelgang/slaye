import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
	name: 'truncatetext'
})
export class TruncatetextPipe implements PipeTransform {

	transform(value: any, length?: any): any {
		const elipses = '...';

		if (typeof value === 'undefined' || value.length <= length) { return value; }

		// truncate to about correct lenght
		const truncatedText = value.slice(0, length);
		return truncatedText + elipses;
	}

}