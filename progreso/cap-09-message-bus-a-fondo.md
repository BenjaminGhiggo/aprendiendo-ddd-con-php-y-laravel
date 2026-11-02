# Capítulo 9 — Going to Town on the Message Bus

> Estado: ⬜ pendiente · Parte II · Fuente: `docs/fuente/...md` (cap. 9)

## La pregunta motor (§3.5)
> _(se completa al empezar)_

## Secciones (índice)
- [ ] 9.a A New Requirement Leads Us to a New Architecture
  - [ ] Imagining an Architecture Change: Everything Will Be an Event Handler
- [ ] 9.b Refactoring Service Functions to Message Handlers
  - [ ] The Message Bus Now Collects Events from the UoW
  - [ ] Our Tests Are All Written in Terms of Events Too
  - [ ] A Temporary Ugly Hack: The Message Bus Has to Return Results
  - [ ] Modifying Our API to Work with Events
- [ ] 9.c Implementing Our New Requirement
  - [ ] Our New Event
- [ ] 9.d Test-Driving a New Handler
  - [ ] Implementation
  - [ ] A New Method on the Domain Model
- [ ] 9.e Optionally: Unit Testing Event Handlers in Isolation with a Fake Message Bus
- [ ] 9.f Wrap-Up
  - [ ] What Have We Achieved?
  - [ ] Why Have We Achieved?

## Figuras del capítulo (§3.8)
- [ ] Figure 9-1. Before
- [ ] Figure 9-2. The message bus is now the main entrypoint to the service layer
- [ ] Figure 9-3. Batch quantity changed means deallocate and reallocate
- [ ] Figure 9-4. Sequence diagram for reallocation flow

## Comprobación (§3.4)
- [ ] Ejercicios · [ ] PHPUnit · [ ] Preguntas de recuerdo · [ ] Integrado en el proyecto
