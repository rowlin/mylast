//app.component.ts
@RouteConfig([
    {
        path: '/',
        name: 'Home',
        component: MainComponent,
        useAsDefault: true
    },
    {
        path: '/edit',
        name: 'Edit',
        component: EditComponent
    }
])
@Component({
    'directives': [ROUTER_DIRECTIVES],
    'selector': 'app',
    'template': '<router-outlet></router-outlet>'
})
export class AppComponent {
    constructor () {}
}